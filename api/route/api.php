<?php
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded  within a group which
| is assigned the "api"  group. Enjoy building your API!
|
*/

$route->addGroup('/mysphinx/api', function ($route) {
    $route->addRoute('GET', '/users', [\Api\Controller\ApiController::class, 'index']);
});


