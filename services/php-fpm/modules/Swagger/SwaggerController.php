<?php

namespace Modules\Swagger;

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @OA\Info(title="My First API", version="0.1")
 */

class SwaggerController
{
    public function index()
    {
        $openapi = \OpenApi\scan('../modules');
        return new \Symfony\Component\HttpFoundation\JsonResponse(json_decode($openapi->toJson()));
    }
}