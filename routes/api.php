<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\TravelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route1 - Origins
Route::get('origins', [TravelController::class, 'index']);
Route::post('origins', [TravelController::class, 'index']);

// Route2 - Destination
Route::get('destinations', [TravelController::class, 'destination']);
Route::post('destinations', [TravelController::class, 'destination']);

// Route3 - Terminals
Route::get('terminals', [TravelController::class, 'terminals']);
Route::post('terminals', [TravelController::class, 'terminals']);



Route::get('origins/{id}', [TravelController::class, 'show']);
Route::get('terminals/{city}', [DestinationController::class, 'terminal']);
