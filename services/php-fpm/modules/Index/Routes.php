<?php

namespace Modules\Index;

use \Symfony\Component\Routing\Route;
use \Symfony\Component\Routing\RouteCollection;

class Routes {
    public static function getRoutes()
    {
        $routes = new RouteCollection();
        $routes->add('health', new Route('/health', ['controller' => IndexController::class, 'method' => 'health']));
        
        return $routes;
    }
}    