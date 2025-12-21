<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\SitemapController;

// Sitemap (fuera de middleware para acceso público)
Route::get('/sitemap.xml', [SitemapController::class, 'index']);

// Home pages with language support
Route::get('/', function () {
    return redirect('/es/', 301);
})->name('home.redirect');

Route::get('/dashboard', function () {
    return view('dashboard-mui');
});

Route::get('/contacto', function () {
    return redirect('/es/contacto', 301);
});
Route::post('/contacto', [ContactController::class, 'store']);

Route::get('/tour/{id}', function () {
    return view('tours.show');
});

Route::get('/destino/{slug}', function () {
    return redirect('/tours');
});

// Landing pages con soporte multiidioma y rutas multiidioma
Route::middleware('locale')->group(function () {
    // Contact routes
    Route::get('/es/contacto', function () {
        return view('contacto');
    })->name('contact.es');

    Route::get('/en/contact', function () {
        return view('contacto');
    })->name('contact.en');

    Route::post('/es/contacto', [ContactController::class, 'store'])->name('contact.store.es');
    Route::post('/en/contact', [ContactController::class, 'store'])->name('contact.store.en');

    Route::get('/es/hoteles-volcan-arenal', function () {
        return view('landings.hotels');
    })->name('landing.hotels.es');

    Route::get('/en/hotels-volcano-arenal', function () {
        return view('landings.hotels');
    })->name('landing.hotels.en');

    Route::get('/es/tours-volcan-arenal', function () {
        return view('landings.tours');
    })->name('landing.tours.es');

    Route::get('/en/tours-volcano-arenal', function () {
        return view('landings.tours');
    })->name('landing.tours.en');

    Route::get('/es/transporte-volcan-arenal', function () {
        return view('landings.transport');
    })->name('landing.transport.es');

    Route::get('/en/transport-volcano-arenal', function () {
        return view('landings.transport');
    })->name('landing.transport.en');

    // HOME PAGE with language support
    Route::get('/es/', function () {
        return view('home');
    })->name('home.es');

    Route::get('/en/', function () {
        return view('home');
    })->name('home.en');

    // TOURS LISTING PAGE with language support
    Route::get('/es/tours', [TourController::class, 'index'])->name('tours.index.es');

    Route::get('/en/tours', [TourController::class, 'index'])->name('tours.index.en');
});

// DETAIL PAGES WITH FULL URL STRUCTURE (Outside middleware for better routing)
Route::middleware('locale')->group(function () {
    // Hotels: /es/provincia/{province}/destino/{destination}/hotel/{hotel}
    Route::get('/es/provincia/{province}/destino/{destination}/hotel/{hotel}', [HotelController::class, 'showComplex'])->name('hotel.show.complex.es');
    Route::get('/en/province/{province}/destination/{destination}/hotel/{hotel}', [HotelController::class, 'showComplex'])->name('hotel.show.complex.en');
    
    // Tours: /es/provincia/{province}/destino/{destination}/tour/{tour}
    Route::get('/es/provincia/{province}/destino/{destination}/tour/{tour}', [TourController::class, 'showComplex'])->name('tour.show.complex.es');
    Route::get('/en/province/{province}/destination/{destination}/tour/{tour}', [TourController::class, 'showComplex'])->name('tour.show.complex.en');
    
    // Simple DETAIL PAGES (fallback)
    Route::get('/es/hotel/{slug}', [HotelController::class, 'show'])->name('hotel.show.es');
    Route::get('/en/hotel/{slug}', [HotelController::class, 'show'])->name('hotel.show.en');

    Route::get('/es/tour/{slug}', [TourController::class, 'show'])->name('tour.show.es');
    Route::get('/en/tour/{slug}', [TourController::class, 'show'])->name('tour.show.en');
});
