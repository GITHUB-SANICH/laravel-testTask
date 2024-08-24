<?php

namespace App\Http\Controllers\Swagger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * @OA\OpenApi(
 *    @OA\Info(
 *       title="API Documentation",
 *       version="1.0.0"
 *    ),
 *    @OA\Components(
 *       @OA\SecurityScheme(
 *           securityScheme="bearerAuth",
 *           type="http",
 *           scheme="bearer",
 *           bearerFormat="JWT"
 *       )
 *    ),
 *    @OA\PathItem(
 *       path="/api/"
 *    )
 * )
 */
class MainController extends Controller
{
	//
}
