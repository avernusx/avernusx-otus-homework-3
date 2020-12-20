<?php

namespace Modules\Index;

use \Symfony\Component\Routing\Route;
use \Symfony\Component\Routing\RouteCollection;

class Routes {
    public static function getRoutes()
    {
        $routes = new RouteCollection();
        
        $routes->add('metrics', new Route('/metrics', ['controller' => IndexController::class, 'method' => 'metrics'],  $methods=['GET']));
        $routes->add('error500', new Route('/error500', ['controller' => IndexController::class, 'method' => 'error500'],  $methods=['GET']));

        return $routes;
    }
}