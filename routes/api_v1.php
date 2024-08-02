<?php

use App\Models\SimCard;
use App\Http\Controllers\Api\V1\ContractController;
use App\Http\Controllers\Api\V1\SimCardController;
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

//Route::get('/test', [SimCardController::class, 'index']);
Route::middleware('auth:sanctum')->group(function () {
	//test
	Route::get('/test', [SimCardController::class, 'index']);

	// Сим-карты
	Route::get('/sim-cards', [SimCardController::class, 'index']);
	Route::get('/sim-cards/{number}', [SimCardController::class, 'searchByNumber']);

	// Контракты
	Route::middleware('role:admin')->group(function () {
		Route::get('/contracts', [ContractController::class, 'index']);
		Route::post('/contracts', [ContractController::class, 'store']);   
	});
});
