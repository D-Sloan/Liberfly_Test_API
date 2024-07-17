<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA; // Importação das anotações do Swagger

/**
 * @OA\Info(
 *     title="Liberfly_test_api",
 *     version="1.0.0",
 *     description="API de teste para a vaga",
 *     @OA\Contact(
 *         email="dsss1@ifal.edu.br"
 *     )
 * )
 */



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
}
