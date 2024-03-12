<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;


#[
    OA\Info(version: "1.0.0", description: "tp7 api", title: "This is tp7 api Documentation"),
    OA\Server(url: 'http://0.0.0.0/', description: "local server"),
    OA\SecurityScheme( securityScheme: 'bearerAuth', type: "http", name: "Authorization", in: "header", scheme: "bearer"),
]




class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
