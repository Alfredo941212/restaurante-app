<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatálogoController;
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
    return view('principal');
});
Route::get('/nosotros', function () {
    return view('nosotros');
});
Route::get('/equipo', function () {
    return view('equipo');
});
Route::get('/mapa', function () {
    return view('geoloca');
});
Route::get('/youtube', function () {
    return view('youtube');
});
Route::get('/twitter', function () {
    return view('twitter');
});
Route::get('/clima', function () {
    return view('clima');
});
Route::resource('cata', CatálogoController::class);