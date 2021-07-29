<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    // dd($request);
    return $request->user();
});
Route::post('/edit-offer', [App\Http\Controllers\OfferController::class, 'edit_offer'])->name('editOffer');
Route::delete('/delete-offer', [App\Http\Controllers\OfferController::class, 'delete_offer'])->name('deleteOffer');