<?php

namespace Modules\Profile;

use \Symfony\Component\Routing\Route;
use \Symfony\Component\Routing\RouteCollection;

class Routes {
    public static function getRoutes()
    {
        $routes = new RouteCollection();
        $routes->add('search-convives',      new Route('/api/v1/profile/convives/search',      ['controller' => ProfileController::class, 'method' => 'convives']));
        $routes->add('convives-liked-me',    new Route('/api/v1/profile/convives/liked-me',    ['controller' => ProfileController::class, 'method' => 'likedMe']));
        $routes->add('convives-liked-by-me', new Route('/api/v1/profile/convives/liked-by-me', ['controller' => ProfileController::class, 'method' => 'likedByMe']));
        $routes->add('drinks',               new Route('/api/v1/profile/drinks',               ['controller' => DrinkController::class,   'method' => 'index']));
        $routes->add('hobby',                new Route('/api/v1/profile/hobby',                ['controller' => HobbyController::class,   'method' => 'index']));
        $routes->add('set-like',             new Route('/api/v1/profile/set-like',             ['controller' => ProfileController::class, 'method' => 'setLike'], $methods=['POST']));
        
        $routes->add('create-profile', new Route('/api/v1/profile/create', ['controller' => UserProfileController::class, 'method' => 'create'], $methods=['POST']));
        $routes->add('update-profile', new Route('/api/v1/profile/update', ['controller' => UserProfileController::class, 'method' => 'update'], $methods=['PUT']));
        $routes->add('view-profile',   new Route('/api/v1/profile/view',   ['controller' => UserProfileController::class, 'method' => 'view']));
        
        return $routes;
    }
}