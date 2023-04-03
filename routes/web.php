<?php

use App\Http\Controllers\DestinationController;
use App\Http\Controllers\OriginController;
use App\Models\WeeklyPlan;
use Illuminate\Support\Facades\Route;

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


Route::get('origins', [OriginController::class, 'index']);
Route::get('destinations/{name}', [DestinationController::class, 'show']);



Route::get('origins/{id}', [OriginController::class, 'show']);
Route::get('terminals/{city}', [DestinationController::class, 'terminal']);
