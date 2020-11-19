<?php

namespace Modules\Swagger;

use \Symfony\Component\Routing\Route;
use \Symfony\Component\Routing\RouteCollection;

class Routes {
    public static function getRoutes()
    {
        $routes = new RouteCollection();
        $routes->add('swagger', new Route('/swagger', ['controller' => SwaggerController::class, 'method' => 'index']));
        return $routes;
    }
}