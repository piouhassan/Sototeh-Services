<?php


require  __DIR__."/../../vendor/autoload.php";


// Add Routing To the Project

$router = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {

    require __DIR__ . "/../route/api.php";
});

$harmony = new WoohooLabs\Harmony\Harmony(Zend\Diactoros\ServerRequestFactory::fromGlobals(), new Zend\Diactoros\Response());

$harmony
    ->addMiddleware(new WoohooLabs\Harmony\Middleware\HttpHandlerRunnerMiddleware(new Zend\HttpHandlerRunner\Emitter\SapiEmitter()))
    ->addMiddleware(new   \Middlewares\Whoops())
    ->addMiddleware(new \App\Http\Middleware\TrailingSlashMiddleware())
    ->addMiddleware(new \App\Http\Middleware\NotFoundMiddleware($router))
    ->addMiddleware(new WoohooLabs\Harmony\Middleware\FastRouteMiddleware($router))
    ->addMiddleware(new WoohooLabs\Harmony\Middleware\DispatcherMiddleware())


;$harmony();