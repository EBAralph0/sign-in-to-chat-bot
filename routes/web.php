<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::resource('clients', ClientController::class);

Route::post('/clients/{id}/validate', [App\Http\Controllers\ClientController::class,'setToValidate'])->name('clients.validate');
Route::post('/clients/{id}/reject', [App\Http\Controllers\ClientController::class,'reject'])->name('clients.reject');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
