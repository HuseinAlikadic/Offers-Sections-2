<?php

use Illuminate\Support\Facades\Route;

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
 
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/offer', [App\Http\Controllers\OfferController::class, 'show_offer'])->name('offer');
Route::post('/add-offer', [App\Http\Controllers\OfferController::class, 'add_offer'])->name('addOffer');
Route::get('/section', [App\Http\Controllers\SectionController::class, 'show_section'])->name('section');