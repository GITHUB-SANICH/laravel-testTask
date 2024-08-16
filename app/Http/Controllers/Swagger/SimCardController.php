<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;


//**
// * @OA\Get(
// * 	path="/api/v1/sim-cards",
// * 	summary="Список симкарт (для клиентов и админов)",
// * 	tags={"SimCards"},
// * 
// * 	@OA\Response(
// * 		response=200,
// * 		description="Ok",  
// * 		@OA\JsonContent(
// * 			@OA\Property(property="", type="array", @OA\Items(
// *					@OA\Property(property="sim", type="integer", example=18),
// *					@OA\Property(property="phone_number", type="string", example="+7-945-333-21"),
// *   				@OA\Property(property="group", type="array", @OA\Items(type="integer", example=20)),
// * 				@OA\Property(property="contract", type="integer", example=14),
// * 			)),
// * 		),
// * 	)
// * ),
// * 
// */
/**
 * @OA\Get(
 * 	path="/api/v1/sim-cards",
 * 	summary="Список симкарт (для клиентов и админов)",
 * 	tags={"SimCards"},
 * 	@OA\Parameter(
 * 		name="role",
 * 		in="query",
 * 		required=true,
 * 		@OA\Schema(
 * 			type="string",
 * 			enum={"client", "admin"},
 * 			default="client"
 * 		),
 * 		description="Роль пользователя"
 * 	),
 * 	@OA\Response(
 * 		response=200,
 * 		description="Ok",  
 * 		@OA\JsonContent(
 * 			@OA\Property(property="sim", type="integer", example=18),
 * 			@OA\Property(property="phone_number", type="string", example="+7-945-333-21"),
 * 			@OA\Property(property="group", type="array", @OA\Items(type="integer", example=20)),
 * 			@OA\Property(property="contract", type="integer", example=14)
 * 		),
 * 	)
 * )
 */
class SimCardController extends Controller {}
