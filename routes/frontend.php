<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


$route->addRoute("GET", "/", [\App\Http\Controllers\frontend\HomeController::class, "index"]);
$route->addRoute("GET", "/nous-contacter", [\App\Http\Controllers\frontend\HomeController::class, "contact"]);
$route->addRoute("POST", "/newsletter/add", [\App\Http\Controllers\frontend\HomeController::class, "addnewletter"]);
$route->addRoute("POST", "/contact/add", [\App\Http\Controllers\frontend\HomeController::class, "addcontact"]);


$route->addRoute("GET", "/solution/category", [\App\Http\Controllers\frontend\HomeController::class, "scategory"]);
$route->addRoute("GET", "/solution/{hash}", [\App\Http\Controllers\frontend\HomeController::class, "subsolution"]);
$route->addRoute("GET", "/solution/detail/{hash}", [\App\Http\Controllers\frontend\HomeController::class, "solution"]);



$route->addRoute("GET", "/services/{hash}", [\App\Http\Controllers\frontend\HomeController::class, "services"]);


$route->addRoute("GET", "/produit/{hash}", [\App\Http\Controllers\frontend\HomeController::class, "subproduit"]);
$route->addRoute("GET", "/produit/sous-categorie/{hash}", [\App\Http\Controllers\frontend\HomeController::class, "produit"]);
$route->addRoute("GET", "/produit/sous-categorie/detail/{hash}", [\App\Http\Controllers\frontend\HomeController::class, "produitdetail"]);

