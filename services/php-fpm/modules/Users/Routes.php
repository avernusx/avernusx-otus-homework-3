<?php

namespace Modules\Users;

use \Symfony\Component\Routing\Route;
use \Symfony\Component\Routing\RouteCollection;

class Routes {
    public static function getRoutes()
    {
        $routes = new RouteCollection();
        
        $routes->add('signup',  new Route('/api/v1/users/create',  ['controller' => UserController::class, 'method' => 'create'],  $methods=['POST']));
        $routes->add('signin',  new Route('/api/v1/users/signin',  ['controller' => UserController::class, 'method' => 'signin'],  $methods=['POST']));
        $routes->add('signout', new Route('/api/v1/users/signout', ['controller' => UserController::class, 'method' => 'signout'], $methods=['POST']));

        $routes->add('create-user',   new Route('/api/v1/users',      ['controller' => UserController::class, 'method' => 'create'],   [], [], null, [], ["POST"]));
        $routes->add('view-user',     new Route('/api/v1/users/{id}', ['controller' => UserController::class, 'method' => 'view'],     [], [], null, [], ["GET"]));
        $routes->add('update-user',   new Route('/api/v1/users/{id}', ['controller' => UserController::class, 'method' => 'update'],   [], [], null, [], ["PUT", "PATCH"]));
        $routes->add('delete-user',   new Route('/api/v1/users/{id}', ['controller' => UserController::class, 'method' => 'delete'],   [], [], null, [], ["DELETE"]));

        return $routes;
    }
}