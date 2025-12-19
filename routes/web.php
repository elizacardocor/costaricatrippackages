<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard-mui');
});

Route::get('/contacto', function () {
    return view('contacto');
});
Route::post('/contacto', [ContactController::class, 'store']);

Route::get('/tours', function () {
    return view('tours.index');
});

Route::get('/tour/{id}', function () {
    return view('tours.show');
});

Route::get('/destino/{slug}', function () {
    return redirect('/tours');
});

// Landing pages con soporte multiidioma
Route::middleware('locale')->group(function () {
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
});
