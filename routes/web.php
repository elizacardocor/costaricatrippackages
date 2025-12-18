<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Dashboard administrativo
Route::get('/dashboard', function () {
    return view('dashboard-mui');
});

// Contacto
Route::get('/contacto', function () {
    return view('contacto');
});
Route::post('/contacto', [ContactController::class, 'store']);

// Tours routes
Route::get('/tours', function () {
    return view('tours.index');
});

Route::get('/tour/{id}', function ($id) {
    return view('tours.show');
});

// Destinos (placeholder para siguiente fase)
Route::get('/destino/{slug}', function ($slug) {
    return redirect('/tours');
});
