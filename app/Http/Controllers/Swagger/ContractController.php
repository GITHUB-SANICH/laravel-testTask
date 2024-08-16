<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;

/**
 * 
 * @OA\Post(
 * 	path="/api/v1/contracts",
 * 	summary="Создание контракта (для админа)",
 * 	tags={"Contracts"},
 * 
 * 	@OA\RequestBody(
 * 		@OA\JsonContent(
 * 			allOf={
 * 				@OA\Schema(
 * 					@OA\Property(property="name", type="string", example="the name for the new contract being created"),
 * 				)
 * 			}
 * 		)
 * 	),
 * 
 * 	@OA\Response(
 * 		response=200,
 * 		description="Ok",
 * 		@OA\JsonContent(
 * 			@OA\Property(property="contract", type="integer", example=18),
 * 			@OA\Property(property="contract_name", type="string", example="name for new created contract"),
 * 		),
 * 	)
 * ),
 * @OA\Get(
 * 	path="/api/v1/contracts",
 * 	summary="Список контрактов (для админа)",
 * 	tags={"Contracts"},
 * 
 * 	@OA\Response(
 * 		response=200,
 * 		description="Ok",  
 * 		@OA\JsonContent(
 * 			@OA\Property(property="", type="array", @OA\Items(
 *					@OA\Property(property="contract", type="integer", example=18),
 * 				@OA\Property(property="contract_name", type="string", example="name for new created contract"),			
 * 			)),
 * 		),
 * 	)
 * ),
 * 
 */


class ContractController extends Controller {}
