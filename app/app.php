<?php


require  __DIR__."/../vendor/autoload.php";

// Start Session @session_start()

\AkConfig\config\Eloquent::load();

$session = new \Akuren\Session\Session();

// Add Routing To the Project

$router = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route){

    // Web Router File Loading
    require __DIR__."/../routes/frontend.php";
    require __DIR__."/../routes/backend.php";
    // Rest Api Router File Loading
    require __DIR__ . "/../api/route/api.php";
});


$session->set('SeeFox', "framework");


$harmony = new WoohooLabs\Harmony\Harmony(Zend\Diactoros\ServerRequestFactory::fromGlobals(), new Zend\Diactoros\Response());








