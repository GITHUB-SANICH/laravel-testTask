<?php
use App\Http\Controllers\Api\V1\ContractController;
use App\Http\Controllers\Api\V1\SimCardController;
use App\Http\Controllers\Api\V1\SimCardGroupController;
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
	//TODO Заметка: Ссылка вывода симок по телефону http://127.0.0.1:8000/api/v1/sim-cards?number=""
	//TODO Заметка: Ссылка вывода групп по страницам http://127.0.0.1:8000/api/v1/sim-card-groups?entries=""
	// Сим-карты
	Route::get('/sim-cards', [SimCardController::class, 'index']);
	// Группы
	Route::get('/sim-card-groups', [SimCardGroupController::class, 'getAllGroups']);
	Route::get('/sim-card-groups/{groupId}', [SimCardGroupController::class, 'getGroup']);
	Route::post('/sim-card-groups/{groupId}/sim-cards', [SimCardGroupController::class, 'addSimCard']);
	Route::delete('/sim-card-groups/{groupId}/sim-cards/{simCardId}', [SimCardGroupController::class, 'removeSimCard']);

	// Контракты
	Route::middleware('admin')->group(function () {
		Route::get('/contracts', [ContractController::class, 'index']);
		Route::post('/contracts', [ContractController::class, 'store']); 
	});
});