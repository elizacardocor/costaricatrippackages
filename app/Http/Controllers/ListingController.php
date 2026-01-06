<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Tour;
use App\Models\Transport;
use App\Models\TourOperator;
use App\Models\User;
use App\Models\RateType;
use App\Models\Amenity;
use App\Models\HotelAmenity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class ListingController extends Controller
{
    /**
     * Mostrar formulario de registrar servicio
     */
    public function create()
    {
        $destinations = Destination::all();
        $rateTypes = RateType::all();
        // Obtener amenidades únicas desde la tabla `hotel_amenities` (no existe tabla global `amenities`)
        // Incluir `id` para que los checkboxes en la vista puedan usarlo como `value`
        $amenities = HotelAmenity::select('id','name','icon')->distinct('name')->get();
        
        return view('listings.create', compact('destinations', 'rateTypes', 'amenities'));
    }

    /**
     * Guardar nuevo servicio
     */
    public function store(Request $request)
    {
        $serviceType = $request->input('service_type');
        
        // Log de depuración
        \Log::info('=== INICIO STORE ===');
        \Log::info('Service Type:', ['service_type' => $serviceType]);
        \Log::info('Todos los inputs:', $request->all());
        \Log::info('Amenities en request:', ['amenities' => $request->input('hotel_amenities')]);
        \Log::info('Prices en request:', ['prices' => $request->input('prices')]);
        \Log::info('Files:', ['files' => array_keys($request->allFiles())]);
        
        // Validación básica común
        $request->validate([
            'destination_id' => 'required|exists:destinations,id',
            'service_type' => 'required|in:hotel,tour,transport',
            'contact_name' => 'required|string|max:255',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string|max:20',
            'contact_address' => 'nullable|string|max:255',
        ]);

        try {
            // Crear o obtener usuario: registramos solo name, email y una
            // contraseña genérica hasheada; `email_verified_at` se mantiene null.
            $user = User::firstOrCreate(
                ['email' => $request->input('contact_email')],
                [
                    'name' => $request->input('contact_name'),
                    'password' => Hash::make('1234567'),
                    'email_verified_at' => null,
                ]
            );

            $destinationId = $request->input('destination_id');
            $service = null;

            if ($serviceType === 'hotel') {
                $service = $this->createHotel($request, $destinationId, $user->id);
            } 
            elseif ($serviceType === 'tour') {
                $service = $this->createTour($request, $destinationId, $user->id);
            } 
            elseif ($serviceType === 'transport') {
                $service = $this->createTransport($request, $destinationId, $user->id);
            }

            if (!$service) {
                return back()->with('error', 'No se pudo crear el servicio');
            }

            \Log::info('Service creado:', ['service_id' => $service->id, 'service_type' => $serviceType]);

            // Guardar precios por temporada
            $this->savePrices($serviceType, $service->id, $request);

            // Construir URL de detalle según el tipo de servicio
            $locale = app()->getLocale();
            
            if ($serviceType === 'hotel') {
                // Para hotels, usar la ruta larga SEO-friendly
                $destination = $service->destinations()->first();
                $province = $destination?->province;
                
                $detailUrl = route('hotel.show.complex.' . $locale, [
                    'province' => $province?->slug ?? 'costa-rica',
                    'destination' => $destination?->slug ?? 'general',
                    'hotel' => $service->slug,
                ]);
            } else {
                // Para tours y transports, usar ruta simple
                $detailUrl = match($serviceType) {
                    'tour' => route('tour.show.' . $locale, ['slug' => $service->slug]),
                    'transport' => route('transport.show.' . $locale, ['slug' => $service->slug]),
                };
            }

            \Log::info('=== FIN STORE EXITOSO ===');
            return redirect($detailUrl)
                ->with('success', __('Tu servicio ha sido registrado exitosamente.'));
        } catch (\Illuminate\Validation\ValidationException $ve) {
            // Log estructurado para errores de validación con flag
            \Log::warning('ListingController::store validation failed', [
                'flag' => 'listing.validation_failed',
                'errors' => $ve->errors(),
                'input' => $request->except(['hotel_image', 'hotel_images']),
            ]);

            if (env('LISTING_DEBUG', false)) {
                return back()->withErrors($ve->errors())->withInput()->with('debug_flag', 'validation_failed');
            }

            return back()->withErrors($ve->errors())->withInput();
        } catch (\Exception $e) {
            // Log estructurado con bandera y nivel de severidad
            \Log::error('ListingController::store exception', [
                'flag' => 'listing.store_exception',
                'severity' => 'high',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->except(['hotel_image', 'hotel_images']),
            ]);

            if (env('LISTING_DEBUG', false)) {
                return back()->with('error', 'Error: ' . $e->getMessage())->with('debug_flag', 'store_exception');
            }

            return back()->with('error', 'Error: Ocurrió un error al procesar tu solicitud.')->with('debug_flag', 'store_exception');
        }
    }

    /**
     * Crear hotel
     */
    private function createHotel($request, $destinationId, $userId)
    {
        $request->validate([
            'hotel_name' => 'required|string|max:255',
            'hotel_description' => 'nullable|string',
            'hotel_stars' => 'nullable|integer|min:1|max:5',
            'hotel_address' => 'nullable|string',
            'hotel_phone' => 'nullable|string',
            'hotel_website' => 'nullable|string',
            'hotel_rooms' => 'nullable|integer',
            'hotel_commission' => 'nullable|numeric|min:0|max:100',
            'hotel_checkin' => 'nullable|date_format:H:i',
            'hotel_checkout' => 'nullable|date_format:H:i',
            // Validación de imágenes: aceptar JPEG/PNG y límite 5MB
            'hotel_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'hotel_images' => 'nullable|array|max:9',
            'hotel_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
            'hotel_amenities' => 'nullable|array',
        ]);

        // Corregir URL si no tiene protocolo
        $website = $request->input('hotel_website');
        if ($website && !preg_match('~^https?://~i', $website)) {
            $website = 'https://' . $website;
        }

        // Asegurar valores por defecto
        $commission = $request->input('hotel_commission');
        if (!$commission || $commission === '') {
            $commission = 0;
        }

        $hotel = Hotel::create([
            'name' => $request->input('hotel_name'),
            'slug' => \Str::slug($request->input('hotel_name')),
            'description' => $request->input('hotel_description'),
            'stars' => $request->input('hotel_stars', 5),
            'phone' => $request->input('hotel_phone'),
            'email' => $request->input('contact_email'),
            'website' => $website,
            'rooms_count' => (int)($request->input('hotel_rooms') ?? 0),
            'commission_percentage' => (float)$commission,
            'checkin_time' => $request->input('hotel_checkin', '14:00:00'),
            'checkout_time' => $request->input('hotel_checkout', '11:00:00'),
            'user_id' => $userId,
            'status' => 'active',
        ]);

        // Guardar imágenes (principal + adicionales)
        $this->saveHotelImages($hotel, $request, $destinationId);

        // Asociar al destino
        $hotel->destinations()->attach($destinationId);

        // Guardar amenidades en la tabla `hotel_amenities` (schema actual)
        \Log::info('Amenidades en request:', [
            'has_amenities' => $request->has('hotel_amenities'),
            'amenities' => $request->input('hotel_amenities'),
        ]);

        $amenitiesInput = $request->input('hotel_amenities');

        if ($request->has('hotel_amenities') && is_array($amenitiesInput)) {
            foreach ($amenitiesInput as $amenityItem) {
                try {
                    $name = null;
                    $icon = null;

                    // Si el item es un array con nombre/icono
                    if (is_array($amenityItem)) {
                        $name = $amenityItem['name'] ?? null;
                        $icon = $amenityItem['icon'] ?? null;
                    }
                    // Si viene un ID (checkbox value), resolver el nombre desde la tabla
                    elseif (is_numeric($amenityItem)) {
                        $source = HotelAmenity::find($amenityItem);
                        if ($source) {
                            $name = $source->name;
                            $icon = $source->icon ?? null;
                        }
                    } else {
                        // Valor simple (posiblemente nombre)
                        $name = (string)$amenityItem;
                    }

                    if ($name) {
                        HotelAmenity::firstOrCreate(
                            ['hotel_id' => $hotel->id, 'name' => $name],
                            ['icon' => $icon]
                        );
                    }
                } catch (\Exception $e) {
                    \Log::error('Error al crear hotel_amenity: ' . $e->getMessage(), ['item' => $amenityItem]);
                }
            }

            \Log::info('Amenidades guardadas en hotel_amenities para hotel_id: ' . $hotel->id);
        } else {
            \Log::warning('No hay amenidades válidas en request');
        }

        return $hotel;
    }

    /**
     * Crear tour
     */
    private function createTour($request, $destinationId, $userId)
    {
        $request->validate([
            'tour_name' => 'required|string|max:255|unique:tours,name',
            'tour_description' => 'nullable|string',
            'tour_duration' => 'nullable|numeric',
            'tour_difficulty' => 'nullable|in:easy,moderate,hard',
            'tour_capacity' => 'nullable|integer',
            'tour_commission' => 'nullable|numeric|min:0|max:100',
            'is_tour_operator' => 'required|in:yes,no',
        ]);

        // Crear o obtener tour operator
        $tourOperator = $this->createOrGetTourOperator($request, $userId);

        $tour = Tour::create([
            'name' => $request->input('tour_name'),
            'slug' => \Str::slug($request->input('tour_name')),
            'description' => $request->input('tour_description'),
            'duration_hours' => $request->input('tour_duration'),
            'difficulty' => $request->input('tour_difficulty', 'moderate'),
            'max_capacity' => $request->input('tour_capacity'),
            'commission_percentage' => $request->input('tour_commission', 0),
            'tour_operator_id' => $tourOperator->id,
            'user_id' => $userId,
            'status' => 'active',
        ]);

        // Asociar al destino
        $tour->destinations()->attach($destinationId);

        return $tour;
    }

    /**
     * Crear o obtener tour operator
     */
    private function createOrGetTourOperator($request, $userId)
    {
        $isOperator = $request->input('is_tour_operator') === 'yes';

        if ($isOperator) {
            // Validar campos de operador
            $request->validate([
                'operator_name' => 'required|string|max:255',
                'operator_phone' => 'required|string|max:20',
                'operator_website' => 'nullable|string',
                'operator_license' => 'nullable|string|max:255',
            ]);

            // Corregir URL si no tiene protocolo
            $website = $request->input('operator_website');
            if ($website && !preg_match('~^https?://~i', $website)) {
                $website = 'https://' . $website;
                $request->merge(['operator_website' => $website]);
            }

            // Crear nuevo operador
            return TourOperator::create([
                'name' => $request->input('operator_name'),
                'phone' => $request->input('operator_phone'),
                'website' => $request->input('operator_website'),
                'license_number' => $request->input('operator_license'),
                'status' => 'active',
            ]);
        } else {
            // Crear operador automático con datos del usuario
            $user = User::find($userId);
            
            return TourOperator::firstOrCreate(
                ['name' => $user->name . ' Tours'],
                [
                    'phone' => $user->phone,
                    'status' => 'active',
                ]
            );
        }
    }

    /**
     * Crear transporte
     */
    private function createTransport($request, $destinationId, $userId)
    {
        $request->validate([
            'transport_name' => 'required|string|max:255|unique:transports,name',
            'transport_type' => 'nullable|string',
            'transport_vehicles' => 'nullable|integer',
            'transport_capacity' => 'nullable|integer',
            'transport_commission' => 'nullable|numeric|min:0|max:100',
        ]);

        $transport = Transport::create([
            'name' => $request->input('transport_name'),
            'slug' => \Str::slug($request->input('transport_name')),
            'type' => $request->input('transport_type'),
            'vehicle_count' => $request->input('transport_vehicles'),
            'capacity_per_vehicle' => $request->input('transport_capacity'),
            'commission_percentage' => $request->input('transport_commission', 0),
            'user_id' => $userId,
            'status' => 'active',
        ]);

        // Asociar al destino
        $transport->destinations()->attach($destinationId);

        return $transport;
    }

    /**
     * Guardar precios por temporada
     */
    private function savePrices($serviceType, $serviceId, $request)
    {
        \Log::info('=== SAVE PRICES START ===');
        \Log::info('savePrices called', [
            'serviceType' => $serviceType,
            'serviceId' => $serviceId,
            'prices' => $request->input('prices'),
            'has_prices' => $request->has('prices'),
        ]);

        if ($request->has('prices')) {
            $priceData = $request->input('prices');
            \Log::info('Precio data:', ['data' => $priceData, 'type' => gettype($priceData)]);
            
            foreach ($priceData as $rateTypeId => $price) {
                \Log::info('Processing price', [
                    'rateTypeId' => $rateTypeId,
                    'price' => $price,
                    'is_numeric' => is_numeric($price),
                    'bool_check' => (bool)$price,
                ]);

                if ($price && is_numeric($price)) {
                    \Log::info('Saving price', [
                        'rateTypeId' => $rateTypeId,
                        'price' => $price,
                    ]);

                    $inserted = \DB::table('pricing')->updateOrInsert(
                        [
                            'service_type' => $serviceType,
                            'service_id' => $serviceId,
                            'rate_type_id' => $rateTypeId,
                        ],
                        [
                            'price' => $price,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                    
                    \Log::info('Price saved', ['inserted' => $inserted]);
                } else {
                    \Log::info('Price skipped', ['price' => $price]);
                }
            }
        } else {
            \Log::warning('No prices provided in request');
        }
        
        \Log::info('=== SAVE PRICES END ===');
    }

    /**
     * Guardar imágenes de hotel con compresión y nombres SEO
     */
    private function saveHotelImages($hotel, $request, $destinationId)
    {
        \Log::info('=== SAVE HOTEL IMAGES START ===');
        \Log::info('saveHotelImages called', [
            'hotel_id' => $hotel->id,
            'has_main_image' => $request->hasFile('hotel_image'),
            'has_additional' => $request->hasFile('hotel_images'),
            'additional_count' => count($request->file('hotel_images') ?? []),
        ]);

        $images = [];
        $order = 1;

        // Obtener datos para construir nombres SEO
        $destination = \App\Models\Destination::find($destinationId);
        $province = $destination?->province;
        
        $hotelName = $hotel->name;
        $provinceName = $province?->name ?? 'Costa Rica';
        $destinationName = $destination?->name ?? 'General';
        $description = $request->input('hotel_description') ?? '';
        
        // Extraer palabras clave de la descripción
        $descriptionWords = collect(preg_split('/\s+/', strtolower($description)))
            ->filter(fn($w) => strlen($w) > 4)
            ->take(3)
            ->values()
            ->toArray();

        // Imagen principal
        if ($request->hasFile('hotel_image')) {
            \Log::info('Processing main image');
            $image = $request->file('hotel_image');
            $fileName = $this->generateImageName($hotelName, $provinceName, $destinationName, $descriptionWords, 1);
            $filePath = $this->compressAndStoreImage($image, 'hotels', $fileName, isMainImage: true);
            
            \Log::info('Main image saved', ['path' => $filePath, 'fileName' => $fileName]);
            
            $altText = "$hotelName en $destinationName, $provinceName - Hotel de Costa Rica";
            
            $images[] = [
                'hotel_id' => $hotel->id,
                'url' => $filePath,
                'alt_text' => $altText,
                'order' => $order++,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Imágenes adicionales
        if ($request->hasFile('hotel_images')) {
            $additionalImages = $request->file('hotel_images');
            \Log::info('Processing additional images', ['count' => count($additionalImages)]);
            
            foreach ($additionalImages as $index => $image) {
                if ($image) {
                    \Log::info('Processing additional image', ['index' => $index, 'order' => $order]);
                    
                    $fileName = $this->generateImageName($hotelName, $provinceName, $destinationName, $descriptionWords, $order);
                    $filePath = $this->compressAndStoreImage($image, 'hotels', $fileName);
                    
                    \Log::info('Additional image saved', ['path' => $filePath, 'fileName' => $fileName]);
                    
                    // Generar alt_text descriptivo para cada imagen
                    $imageDescriptions = [
                        'habitación',
                        'piscina',
                        'restaurante',
                        'vista',
                        'amenidades',
                        'entrada',
                        'salón',
                        'jardín',
                        'galería'
                    ];
                    
                    $desc = $imageDescriptions[$index % count($imageDescriptions)];
                    $altText = "$desc - $hotelName $destinationName $provinceName - Hotel en Costa Rica";
                    
                    $images[] = [
                        'hotel_id' => $hotel->id,
                        'url' => $filePath,
                        'alt_text' => $altText,
                        'order' => $order++,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        // Guardar todas las imágenes
        if (!empty($images)) {
            \Log::info('Inserting images to database', ['count' => count($images)]);
            $result = \DB::table('hotel_images')->insert($images);
            \Log::info('Images inserted', ['result' => $result, 'count' => count($images)]);
        } else {
            \Log::warning('No images to save');
        }
        
        \Log::info('=== SAVE HOTEL IMAGES END ===');
    }

    /**
     * Generar nombre SEO-friendly para la imagen
     */
    private function generateImageName($hotelName, $provinceName, $destinationName, $descriptionWords, $order)
    {
        $baseName = \Str::slug("$hotelName $provinceName $destinationName");
        
        if (!empty($descriptionWords)) {
            $keyword = $descriptionWords[$order % count($descriptionWords)];
            $baseName .= "-$keyword";
        }
        
        $baseName .= "-" . $order;
        
        return $baseName;
    }

    /**
     * Comprimir imagen y guardarla con optimización para web
     */
    private function compressAndStoreImage($uploadedFile, $directory, $customName, $isMainImage = false)
    {
        try {
            $image = \Intervention\Image\ImageManager::gd()->read($uploadedFile);
            
            // Para imagen principal: optimizar para 16:9 (hero 1200x675)
            // Para imágenes adicionales: 1200px máximo manteniendo aspecto
            if ($isMainImage) {
                // Redimensionar a 1200x675 (16:9 para el hero)
                // Primero escala para que el ancho sea 1200
                $image->scaleDown(width: 1200);
                
                // Luego recorta a 16:9 si es necesario
                $width = $image->width();
                $height = $image->height();
                $targetHeight = intdiv($width * 9, 16);
                
                if ($height > $targetHeight) {
                    // Centra el crop verticalmente
                    $y = intdiv($height - $targetHeight, 2);
                    $image->crop(width: $width, height: $targetHeight, offset_x: 0, offset_y: $y);
                }
            } else {
                // Para otras imágenes: máximo 1200px de ancho
                $image->scaleDown(width: 1200);
            }
            
            // Comprimir a JPEG con calidad adaptativa
            // Imagen principal: 80% (mejor calidad para hero)
            // Otras imágenes: 75% (buen balance)
            $quality = $isMainImage ? 80 : 75;
            $encoded = $image->toJpeg(quality: $quality);
            
            // Nombre del archivo
            $fileName = $customName . '.jpg';
            
            // Guardar en storage
            $path = "public/$directory/$fileName";
            \Storage::put($path, $encoded);
            
            \Log::info('Image compressed and stored', ['path' => $path, 'isMain' => $isMainImage]);
            
            // Retornar ruta relativa para guardar en BD
            return "$directory/$fileName";
        } catch (\Exception $e) {
            \Log::error('Error compressing image: ' . $e->getMessage());
            throw $e;
        }
    }
}
