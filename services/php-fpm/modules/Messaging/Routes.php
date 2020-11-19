<?php

namespace Modules\Messaging;

use \Symfony\Component\Routing\Route;
use \Symfony\Component\Routing\RouteCollection;

class Routes 
{
    public static function getRoutes()
    {
        $routes = new RouteCollection();
        $routes->add('chats',       new Route('/api/v1/messaging/chats',        ['controller' => ChatController::class, 'method' => 'chats']));
        $routes->add('create-chat', new Route('/api/v1/messaging/chats/create', ['controller' => ChatController::class, 'method' => 'createChat'], $methods=['POST']));
        $routes->add('messages',    new Route('/api/v1/messaging/messages',     ['controller' => ChatController::class, 'method' => 'messages']));
        return $routes;
    }
}