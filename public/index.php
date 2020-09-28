<?php
require  __DIR__."/../app/app.php";

$harmony
    ->addMiddleware(new WoohooLabs\Harmony\Middleware\HttpHandlerRunnerMiddleware(new Zend\HttpHandlerRunner\Emitter\SapiEmitter()))
    ->addMiddleware(new   \Middlewares\Whoops())
    ->addMiddleware(new \App\Http\Middleware\TrailingSlashMiddleware())
   // ->addMiddleware(new \App\Http\Middleware\LangMiddleware($lang, $session))
    ->addMiddleware(new \App\Http\Middleware\NotFoundMiddleware($router))
    ->addMiddleware(new \App\Http\Middleware\LoggedAdminMiddleware())
    ->addMiddleware(new WoohooLabs\Harmony\Middleware\FastRouteMiddleware($router))
    ->addMiddleware(new WoohooLabs\Harmony\Middleware\DispatcherMiddleware())
;$harmony();




