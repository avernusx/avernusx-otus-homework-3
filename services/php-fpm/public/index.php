<?php

use \Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\Routing\RouteCollection;
use \Symfony\Component\Routing\RequestContext;
use \Symfony\Component\Routing\Matcher\UrlMatcher;
use \Symfony\Component\Validator\Validation;

use \Doctrine\ORM\Tools\Setup;
use \Doctrine\ORM\EntityManager;
use \Doctrine\Common\Annotations\AnnotationRegistry;
use \Doctrine\Common\Annotations\AnnotationReader;

use \Modules\Core\JsonRequest;

$startTime = microtime(true);

$loader = require '../vendor/autoload.php';

\Prometheus\Storage\Redis::setDefaultOptions(
    [
        'host' => $_ENV['REDIS_HOST'],
        'port' => 6379,
        'password' => 'dev',
    ]
);

$prometheus = \Prometheus\CollectorRegistry::getDefault();
$histogram = $prometheus->getOrRegisterHistogram('', 'avernusx_latency', '', ['type']);

AnnotationRegistry::registerLoader([$loader, 'loadClass']);
AnnotationReader::addGlobalIgnoredName('OA\Schema');
AnnotationReader::addGlobalIgnoredName('OA\Property');
AnnotationReader::addGlobalIgnoredName('Column');
AnnotationReader::addGlobalIgnoredName('Table');
AnnotationReader::addGlobalIgnoredName('Entity');
AnnotationReader::addGlobalIgnoredName('Id');
AnnotationReader::addGlobalIgnoredName('GeneratedValue');

$subroutes = [
    \Modules\Messaging\Routes::class,
    \Modules\Profile\Routes::class,
    \Modules\Users\Routes::class,
    \Modules\Swagger\Routes::class,
    \Modules\Index\Routes::class
];

$request = JsonRequest::createFromGlobals();

$routes = new RouteCollection();

foreach ($subroutes as $subroute) {
    $routes->addCollection($subroute::getRoutes());
}

$context = new RequestContext();

$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$currentRoute = $matcher->matchRequest($request);

$entityManager = EntityManager::create(
    [
        'driver'   => 'pdo_pgsql',
        'host'     => $_ENV['DB_HOST'],
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASS'],
        'dbname'   => $_ENV['DB_NAME'],
    ], 
    Setup::createAnnotationMetadataConfiguration(["../modules"], true)
);

$validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
$controller = new $currentRoute['controller']($entityManager, $validator, $prometheus);
$method = $currentRoute['method'];

try {
    $response = $controller->$method($request, $currentRoute);
} catch (Exception $exception) {
    $prometheus->getOrRegisterCounter('', 'avernusx_error500', '')->inc();
    $prometheus->getOrRegisterCounter('', 'requests', '')->inc();
    http_response_code(500);

    $endTime = microtime(true);
    $histogram->observe($endTime - $startTime, ['blue']);

    throw $exception;
}

$response->send();

$prometheus->getOrRegisterCounter('', 'avernusx_requests', '')->inc();
$endTime = microtime(true);
$histogram->observe($endTime - $startTime, ['blue']);