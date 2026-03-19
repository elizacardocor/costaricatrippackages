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
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;

class ListingController extends Controller
{
    /**
     * Mostrar formulario de registrar servicio
     */
    public function create()
    {
        $destinations = Destination::all();
        $rateTypes = RateType::all();
        // Si existe la tabla global `amenities`, usarla (lista canonical).
        // Si no, agrupar por `name` desde `hotel_amenities` como fallback.
        if (Schema::hasTable('amenities')) {
            $amenities = Amenity::select('id', 'name', 'icon')->orderBy('name')->get();
        } else {
            $amenities = HotelAmenity::selectRaw('MIN(id) as id, name, MIN(icon) as icon')
                ->groupBy('name')
                ->orderBy('name')
                ->get();
        }
        
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
        \Log::info('¿Hay archivo service_video?', ['hasFile' => $request->hasFile('service_video')]);
        // Procesar video si se subió
        $videoUrl = null;
        if ($request->hasFile('service_video')) {
            $videoFile = $request->file('service_video');
            $originalExt = $videoFile->getClientOriginalExtension();
            $serviceSlug = null;
            $videoDir = 'videos';
            $webmName = null;
            $serviceIdForPath = null;

            // Definir slug y carpeta según tipo
            if ($serviceType === 'hotel') {
                $serviceSlug = \Str::slug($request->input('hotel_name'));
            } elseif ($serviceType === 'tour') {
                $serviceSlug = \Str::slug($request->input('tour_name'));
            } elseif ($serviceType === 'transport') {
                $serviceSlug = \Str::slug($request->input('transport_name'));
            }

            // Nombre de archivo único
            $webmName = $serviceSlug . '-' . time() . '.webm';
            $tmpPath = $videoFile->storeAs('tmp', uniqid('video_') . '.' . $originalExt, 'local');
            $tmpFullPath = storage_path('app/' . $tmpPath);
            $storageVideoDir = storage_path('app/public/' . $videoDir);
            \Log::info('Ruta esperada para videos:', ['storageVideoDir' => $storageVideoDir]);
            if (!file_exists($storageVideoDir)) {
                $mkdirResult = mkdir($storageVideoDir, 0775, true);
                \Log::info('Intento de crear directorio videos', ['result' => $mkdirResult, 'dir' => $storageVideoDir]);
            } else {
                \Log::info('Directorio videos ya existe', ['dir' => $storageVideoDir]);
            }
            $storageWebmPath = $storageVideoDir . '/' . $webmName;

            // Ejecutar FFmpeg para convertir a WebM
            $ffmpegCmd = "ffmpeg -i \"$tmpFullPath\" -c:v libvpx-vp9 -b:v 1M -c:a libopus -vf 'scale=trunc(iw/2)*2:trunc(ih/2)*2' -y \"$storageWebmPath\"";
            exec($ffmpegCmd, $output, $returnVar);
            if ($returnVar === 0 && file_exists($storageWebmPath)) {
                // La URL pública será storage/videos/archivo.webm
                $videoUrl = 'storage/' . $videoDir . '/' . $webmName;
            } else {
                \Log::error('Error al convertir video a WebM', ['cmd' => $ffmpegCmd, 'output' => $output, 'return' => $returnVar]);
                $videoUrl = null;
            }
            // Limpiar archivo temporal
            @unlink($tmpFullPath);
        }
        // Validación de precios por temporada (requeridos)
        $rateTypes = RateType::all();
        $priceRules = [];
        foreach ($rateTypes as $rateType) {
            $priceRules['prices.' . $rateType->id] = 'required|numeric|min:0.01';
        }
        $request->validate($priceRules, [
            'prices.*.required' => 'El precio es requerido para todas las temporadas',
            'prices.*.numeric' => 'El precio debe ser un número válido',
            'prices.*.min' => 'El precio debe ser mayor a 0',
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
                if ($videoUrl) {
                    $service->video_url = $videoUrl;
                    $service->save();
                }
            } 
            elseif ($serviceType === 'tour') {
                $service = $this->createTour($request, $destinationId, $user->id);
                if ($videoUrl) {
                    $service->video_url = $videoUrl;
                    $service->save();
                }
            } 
            elseif ($serviceType === 'transport') {
                $service = $this->createTransport($request, $destinationId, $user->id);
                if ($videoUrl) {
                    $service->video_url = $videoUrl;
                    $service->save();
                }
            }

            if (!$service) {
                return back()->with('error', 'No se pudo crear el servicio');
            }

            \Log::info('Service creado:', ['service_id' => $service->id, 'service_type' => $serviceType]);

            // Guardar imágenes según el tipo de servicio
            if ($serviceType === 'tour') {
                $this->saveTourImages($service, $request, $destinationId);
            } elseif ($serviceType === 'transport') {
                $this->saveTransportImages($service, $request, $destinationId);
            }

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

        // Corregir URL si no tiene protocolo: aceptar http(s) o añadir http:// por defecto
        $website = $request->input('hotel_website');
        if ($website && !preg_match('~^https?://~i', $website)) {
            $website = 'http://' . $website;
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
            'status' => 'pending',
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
                    // Si viene un ID (checkbox value), puede ser id de `amenities` o de `hotel_amenities`
                    elseif (is_numeric($amenityItem)) {
                        // Primero buscar en tabla canonical `amenities`
                        $global = Amenity::find($amenityItem);
                        if ($global) {
                            $name = $global->name;
                            $icon = $global->icon ?? null;
                            $amenityId = $global->id;
                        } else {
                            // Fallback: buscar en hotel_amenities (por si el listado estaba basado en esa tabla)
                            $source = HotelAmenity::find($amenityItem);
                            if ($source) {
                                $name = $source->name;
                                $icon = $source->icon ?? null;
                                $amenityId = $source->amenity_id ?? null;
                            }
                        }
                    } else {
                        // Valor simple (posiblemente nombre)
                        $name = (string)$amenityItem;
                    }

                    if ($name) {
                        // Si tenemos un amenity_id canonical, lo guardamos en hotel_amenities
                        $attributes = ['hotel_id' => $hotel->id, 'name' => $name];
                        if (!empty($amenityId)) {
                            $attributes['amenity_id'] = $amenityId;
                        }

                        $values = ['icon' => $icon];

                        HotelAmenity::firstOrCreate($attributes, $values);
                        // limpiar variable para la siguiente iteración
                        $amenityId = null;
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
            'tour_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'tour_images' => 'nullable|array|max:9',
            'tour_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
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
            'status' => 'pending',
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

            // Corregir URL si no tiene protocolo: aceptar http(s) o añadir http:// por defecto
            $website = $request->input('operator_website');
            if ($website && !preg_match('~^https?://~i', $website)) {
                $website = 'http://' . $website;
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
            'transport_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'transport_images' => 'nullable|array|max:9',
            'transport_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $transport = Transport::create([
            'name' => $request->input('transport_name'),
            'slug' => \Str::slug($request->input('transport_name')),
            'type' => $request->input('transport_type'),
            'vehicle_count' => $request->input('transport_vehicles'),
            'capacity_per_vehicle' => $request->input('transport_capacity'),
            'commission_percentage' => $request->input('transport_commission', 0),
            'user_id' => $userId,
            'status' => 'pending',
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
            
            // Mapear serviceType a nombre completo de clase
            $classMap = [
                'hotel' => 'App\Models\Hotel',
                'tour' => 'App\Models\Tour',
                'transport' => 'App\Models\Transport',
            ];
            $serviceClass = $classMap[$serviceType] ?? 'App\Models\\' . ucfirst($serviceType);
            
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
                            'service_type' => $serviceClass,
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
     * Guardar imágenes del tour
     */
    private function saveTourImages($tour, $request, $destinationId)
    {
        \Log::info('=== SAVE TOUR IMAGES START ===');
        \Log::info('saveTourImages called', [
            'tour_id' => $tour->id,
            'has_main_image' => $request->hasFile('tour_image'),
            'has_additional' => $request->hasFile('tour_images'),
            'additional_count' => count($request->file('tour_images') ?? []),
        ]);

        $images = [];
        $order = 1;

        // Obtener datos para construir nombres SEO
        $destination = \App\Models\Destination::find($destinationId);
        $province = $destination?->province;
        
        $tourName = $tour->name;
        $provinceName = $province?->name ?? 'Costa Rica';
        $destinationName = $destination?->name ?? 'General';
        $description = $request->input('tour_description') ?? '';
        
        // Extraer palabras clave de la descripción
        $descriptionWords = collect(preg_split('/\s+/', strtolower($description)))
            ->filter(fn($w) => strlen($w) > 4)
            ->take(3)
            ->values()
            ->toArray();

        // Imagen principal
        if ($request->hasFile('tour_image')) {
            \Log::info('Processing main tour image');
            $image = $request->file('tour_image');
            $fileName = $this->generateImageName($tourName, $provinceName, $destinationName, $descriptionWords, 1);
            $filePath = $this->compressAndStoreImage($image, 'tours', $fileName, isMainImage: true);
            
            \Log::info('Main tour image saved', ['path' => $filePath, 'fileName' => $fileName]);
            
            $altText = "$tourName en $destinationName, $provinceName - Tour de Costa Rica";
            
            $images[] = [
                'tour_id' => $tour->id,
                'url' => $filePath,
                'alt_text' => $altText,
                'order' => $order++,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Imágenes adicionales
        if ($request->hasFile('tour_images')) {
            $additionalImages = $request->file('tour_images');
            \Log::info('Processing additional tour images', ['count' => count($additionalImages)]);
            
            foreach ($additionalImages as $index => $image) {
                if ($image) {
                    \Log::info('Processing additional tour image', ['index' => $index, 'order' => $order]);
                    
                    $fileName = $this->generateImageName($tourName, $provinceName, $destinationName, $descriptionWords, $order);
                    $filePath = $this->compressAndStoreImage($image, 'tours', $fileName);
                    
                    \Log::info('Additional tour image saved', ['path' => $filePath, 'fileName' => $fileName]);
                    
                    // Generar alt_text descriptivo para cada imagen
                    $imageDescriptions = [
                        'actividad',
                        'paisaje',
                        'aventura',
                        'vista',
                        'experiencia',
                        'destino',
                        'atracción',
                        'naturaleza',
                        'galería'
                    ];
                    
                    $desc = $imageDescriptions[$index % count($imageDescriptions)];
                    $altText = "$desc - $tourName $destinationName $provinceName - Tour en Costa Rica";
                    
                    $images[] = [
                        'tour_id' => $tour->id,
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
            \Log::info('Inserting tour images to database', ['count' => count($images)]);
            $result = \DB::table('tour_images')->insert($images);
            \Log::info('Tour images inserted', ['result' => $result, 'count' => count($images)]);
        } else {
            \Log::warning('No tour images to save');
        }
        
        \Log::info('=== SAVE TOUR IMAGES END ===');
    }

    /**
     * Guardar imágenes del transporte
     */
    private function saveTransportImages($transport, $request, $destinationId)
    {
        \Log::info('=== SAVE TRANSPORT IMAGES START ===');
        \Log::info('saveTransportImages called', [
            'transport_id' => $transport->id,
            'has_main_image' => $request->hasFile('transport_image'),
            'has_additional' => $request->hasFile('transport_images'),
            'additional_count' => count($request->file('transport_images') ?? []),
        ]);

        $images = [];
        $order = 1;

        // Obtener datos para construir nombres SEO
        $destination = \App\Models\Destination::find($destinationId);
        $province = $destination?->province;
        
        $transportName = $transport->name;
        $provinceName = $province?->name ?? 'Costa Rica';
        $destinationName = $destination?->name ?? 'General';
        $type = $request->input('transport_type') ?? 'transporte';
        
        // Extraer palabras clave del tipo
        $descriptionWords = [$type, 'vehiculo', 'servicio'];

        // Imagen principal
        if ($request->hasFile('transport_image')) {
            \Log::info('Processing main transport image');
            $image = $request->file('transport_image');
            $fileName = $this->generateImageName($transportName, $provinceName, $destinationName, $descriptionWords, 1);
            $filePath = $this->compressAndStoreImage($image, 'transports', $fileName, isMainImage: true);
            
            \Log::info('Main transport image saved', ['path' => $filePath, 'fileName' => $fileName]);
            
            $altText = "$transportName en $destinationName, $provinceName - Transporte de Costa Rica";
            
            $images[] = [
                'transport_id' => $transport->id,
                'url' => $filePath,
                'alt_text' => $altText,
                'order' => $order++,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Imágenes adicionales
        if ($request->hasFile('transport_images')) {
            $additionalImages = $request->file('transport_images');
            \Log::info('Processing additional transport images', ['count' => count($additionalImages)]);
            
            foreach ($additionalImages as $index => $image) {
                if ($image) {
                    \Log::info('Processing additional transport image', ['index' => $index, 'order' => $order]);
                    
                    $fileName = $this->generateImageName($transportName, $provinceName, $destinationName, $descriptionWords, $order);
                    $filePath = $this->compressAndStoreImage($image, 'transports', $fileName);
                    
                    \Log::info('Additional transport image saved', ['path' => $filePath, 'fileName' => $fileName]);
                    
                    // Generar alt_text descriptivo para cada imagen
                    $imageDescriptions = [
                        'vehículo',
                        'interior',
                        'servicio',
                        'flota',
                        'comodidad',
                        'destino',
                        'ruta',
                        'transporte',
                        'galería'
                    ];
                    
                    $desc = $imageDescriptions[$index % count($imageDescriptions)];
                    $altText = "$desc - $transportName $destinationName $provinceName - Transporte en Costa Rica";
                    
                    $images[] = [
                        'transport_id' => $transport->id,
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
            \Log::info('Inserting transport images to database', ['count' => count($images)]);
            $result = \DB::table('transport_images')->insert($images);
            \Log::info('Transport images inserted', ['result' => $result, 'count' => count($images)]);
        } else {
            \Log::warning('No transport images to save');
        }
        
        \Log::info('=== SAVE TRANSPORT IMAGES END ===');
    }

    /**
     * Generar nombre SEO-friendly para la imagen
     */
    private function generateImageName($hotelName, $provinceName, $destinationName, $descriptionWords, $order)
    {
        // Añadir año, mes y palabras clave SEO
        $date = now();
        $year = $date->year;
        $month = str_pad($date->month, 2, '0', STR_PAD_LEFT);

        // Detectar tipo de servicio para palabra clave
        $serviceType = 'servicio';
        if (stripos($hotelName, 'hotel') !== false) {
            $serviceType = 'hotel';
        } elseif (stripos($hotelName, 'tour') !== false) {
            $serviceType = 'tour';
        } elseif (stripos($hotelName, 'transporte') !== false) {
            $serviceType = 'transporte';
        }

        $baseName = \Str::slug("$hotelName $provinceName $destinationName $serviceType Costa Rica $year $month");

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
            // Si la librería Intervention no está disponible (hosting compartido),
            // intentamos usar GD nativo para redimensionar/comprimir; si no, guardamos el archivo crudo.
            if (!class_exists('Intervention\\Image\\ImageManager')) {
                if (extension_loaded('gd')) {
                    \Log::warning('Intervention Image not found, using native GD image processing fallback');

                    $tmpPath = $uploadedFile->getPathname();
                    if (!file_exists($tmpPath)) {
                        // fallback al guardado directo
                        $ext = $uploadedFile->getClientOriginalExtension() ?: 'jpg';
                        $fileName = $customName . '.' . $ext;
                        \Storage::putFileAs("public/$directory", $uploadedFile, $fileName);
                        \Log::warning('Saved raw uploaded file (GD no tmp path fallback)', ['path' => "public/$directory/$fileName"]);
                        return "$directory/$fileName";
                    }

                    [$width, $height, $type] = getimagesize($tmpPath);

                    switch ($type) {
                        case IMAGETYPE_JPEG:
                            $src = imagecreatefromjpeg($tmpPath);
                            break;
                        case IMAGETYPE_PNG:
                            $src = imagecreatefrompng($tmpPath);
                            break;
                        case IMAGETYPE_GIF:
                            $src = imagecreatefromgif($tmpPath);
                            break;
                        default:
                            // formato no soportado por GD -> guardar crudo
                            $ext = $uploadedFile->getClientOriginalExtension() ?: 'jpg';
                            $fileName = $customName . '.' . $ext;
                            \Storage::putFileAs("public/$directory", $uploadedFile, $fileName);
                            return "$directory/$fileName";
                    }

                    // Escalar manteniendo aspecto
                    $targetWidth = 1200;
                    if ($isMainImage) {
                        $targetWidth = 1200;
                    }

                    if ($width > $targetWidth) {
                        $newHeight = intval($height * ($targetWidth / $width));
                        $resized = imagecreatetruecolor($targetWidth, $newHeight);
                        // preservar transparencia para PNG/GIF by filling with white background
                        imagefill($resized, 0, 0, imagecolorallocate($resized, 255, 255, 255));
                        imagecopyresampled($resized, $src, 0, 0, 0, 0, $targetWidth, $newHeight, $width, $height);
                    } else {
                        $resized = imagecreatetruecolor($width, $height);
                        imagefill($resized, 0, 0, imagecolorallocate($resized, 255, 255, 255));
                        imagecopyresampled($resized, $src, 0, 0, 0, 0, $width, $height, $width, $height);
                        $newHeight = $height;
                    }

                    // Si es imagen principal, recortar a 16:9
                    if ($isMainImage) {
                        $cropHeight = intdiv($targetWidth * 9, 16); // 675
                        if ($newHeight > $cropHeight) {
                            $y = intdiv($newHeight - $cropHeight, 2);
                            $crop = imagecreatetruecolor($targetWidth, $cropHeight);
                            imagecopy($crop, $resized, 0, 0, 0, $y, $targetWidth, $cropHeight);
                            imagedestroy($resized);
                            $finalImg = $crop;
                        } else {
                            $finalImg = $resized;
                        }
                    } else {
                        $finalImg = $resized;
                    }

                    $quality = $isMainImage ? 80 : 75;

                    // Obtener contenido JPEG desde GD
                    ob_start();
                    imagejpeg($finalImg, null, $quality);
                    $jpeg = ob_get_clean();

                    // Nombre del archivo JPG
                    $fileName = $customName . '.jpg';
                    $path = "public/$directory/$fileName";
                    \Storage::put($path, $jpeg);

                    \Log::info('Image compressed and stored (GD)', ['path' => $path, 'isMain' => $isMainImage]);

                    // Liberar recursos
                    imagedestroy($src);
                    imagedestroy($finalImg);

                    return "$directory/$fileName";
                }

                \Log::warning('Intervention and GD not available, storing raw file fallback');
                $ext = $uploadedFile->getClientOriginalExtension() ?: 'jpg';
                $fileName = $customName . '.' . $ext;
                \Storage::putFileAs("public/$directory", $uploadedFile, $fileName);
                \Log::info('Raw file stored (no GD/intervention)', ['path' => "public/$directory/$fileName"]);
                return "$directory/$fileName";
            }

            if (extension_loaded('imagick')) {
                $manager = ImageManager::imagick();
            } else {
                $manager = ImageManager::gd();
            }

            // Use read() with the uploaded file path to create an image instance
            $image = $manager->read($uploadedFile->getPathname());
            
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
            
            // Comprimir a JPEG y WebP con calidad adaptativa
            $quality = $isMainImage ? 80 : 75;
            $encodedJpg = $image->toJpeg(quality: $quality);
            $encodedWebp = null;
            // WebP solo si Intervention soporta
            try {
                $encodedWebp = $image->toWebp(quality: $quality);
            } catch (\Throwable $e) {
                \Log::warning('WebP conversion failed or not supported: ' . $e->getMessage());
            }

            // Nombre de archivos
            $fileNameJpg = $customName . '.jpg';
            $fileNameWebp = $customName . '.webp';

            // Guardar en storage
            $pathJpg = "public/$directory/$fileNameJpg";
            \Storage::put($pathJpg, $encodedJpg);
            if ($encodedWebp) {
                $pathWebp = "public/$directory/$fileNameWebp";
                \Storage::put($pathWebp, $encodedWebp);
                \Log::info('Image also stored as WebP', ['path' => $pathWebp]);
            }

            \Log::info('Image compressed and stored', ['path' => $pathJpg, 'isMain' => $isMainImage]);

            // Retornar ruta relativa JPG para guardar en BD
            return "$directory/$fileNameJpg";
        } catch (\Exception $e) {
            \Log::error('Error compressing image: ' . $e->getMessage());
            throw $e;
        }
    }
}
