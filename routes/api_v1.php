<?php

use App\Models\SimCard;
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

Route::middleware('auth:sanctum')->group(function () {
	Route::get('/sim-cards', [SimCard::class, 'index']);
	Route::get('/sim-cards', [SimCard::class, 'getSimCardsForSimCardGroup']);
	Route::get('/sim-cards', [SimCard::class, 'index'])->middleware('role:admin');
	Route::get('/sim-cards', [SimCard::class, 'getSimCardForContracts'])->middleware('role:admin');
	Route::post('/sim-cards', [SimCard::class, 'getSimCardForContracts'])->middleware('role:admin');
});
