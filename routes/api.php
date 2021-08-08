<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SectionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
 
Route::middleware('auth:api')->get('/user', function (Request $request) {
 
    return $request->user();
});

Route::post('/add-offer', [OfferController::class, 'add_offer'])->name('addOffer');
Route::post('/edit-offer', [OfferController::class, 'edit_offer'])->name('editOffer');
Route::delete('/delete-offer', [OfferController::class, 'delete_offer'])->name('deleteOffer');

Route::get('/search-offer', [OfferController::class, 'search_offer_by_title'])->name('searchOffer');