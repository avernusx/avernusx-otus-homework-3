<?php

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\RouteCollection;
use \Symfony\Component\Routing\RequestContext;
use \Symfony\Component\Routing\Matcher\UrlMatcher;

use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;

require '../vendor/autoload.php';

$subroutes = [
    \Modules\Index\Routes::class,
];

$request = Request::createFromGlobals();

$routes = new RouteCollection();

foreach ($subroutes as $subroute) {
    $routes->addCollection($subroute::getRoutes());
}

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$currentRoute = $matcher->match($request->getPathInfo());

$entityManager = EntityManager::create(
    [
        'driver'   => 'pdo_pgsql',
        'host'     => 'postgresql',
        'user'     => 'otus',
        'password' => 'otus',
        'dbname'   => 'otus',
    ], 
    Setup::createAnnotationMetadataConfiguration(["../modules"], true)
);

$controller = new $currentRoute['controller']($entityManager);
$method = $currentRoute['method'];
$response = $controller->$method($request);
$response->send();