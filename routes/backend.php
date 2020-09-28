<?php

use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\LoginController;
use App\Http\Controllers\backend\MessageController;
use App\Http\Controllers\backend\Products\ProductController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\backend\Services\CategoryController;
use App\Http\Controllers\backend\Services\ServiceController;
use App\Http\Controllers\backend\Solutions\CategorieController;
use App\Http\Controllers\backend\Solutions\SolutionController;
use App\Http\Controllers\backend\Solutions\SubCategoryController;
use App\Http\Controllers\backend\Solutions\TimelineController;
use App\Http\Controllers\backend\StatistiqueController;
use App\Http\Controllers\backend\UserController;


$route->addGroup('/admin', function ($route) {
    $route->addRoute("GET", '', [DashboardController::class, "index"]);
    $route->addRoute("GET", '/dashboard', [DashboardController::class, "index"]);
    $route->addRoute("GET", '/statistiques', [StatistiqueController::class, "index"]);
    $route->addRoute("GET", '/messages', [MessageController::class, "index"]);
    $route->addRoute("GET", '/messages/{message}', [MessageController::class, "show"]);
    $route->addRoute("GET", '/messages/{message}/delete', [MessageController::class, "delete"]);
    $route->addRoute("GET", '/login', [LoginController::class, "loginForm"]);
    $route->addRoute("POST", '/login', [LoginController::class, "login"]);
    $route->addRoute("GET", '/logout', [LoginController::class, "logout"]);
    $route->addRoute("GET", '/profile', [ProfileController::class, "index"]);
    $route->addRoute("POST", '/profile/avatar/update', [ProfileController::class, "updatePhoto"]);
    $route->addRoute("POST", '/profile/update', [ProfileController::class, "update"]);
    $route->addRoute("POST", '/profile/password/update', [ProfileController::class, "passwordUpdate"]);
    $route->addGroup('/users', function ($route) {
        $route->addRoute("GET", '', [UserController::class, "index"]);
        $route->addRoute("GET", '/create', [UserController::class, "create"]);
        $route->addRoute("POST", '/store', [UserController::class, "store"]);
        $route->addRoute("GET", '/{user}/delete', [UserController::class, "delete"]);
        $route->addRoute("GET", '/{user}/lock', [UserController::class, "lock"]);
        $route->addRoute("GET", '/{user}/unlock', [UserController::class, "unlock"]);
    });
    $route->addGroup('/solutions', function ($route) {
        $route->addRoute("GET", '', [SolutionController::class, "index"]);
        $route->addRoute("POST", '/store', [SolutionController::class, "store"]);
        $route->addRoute("POST", '/{solution}/update', [SolutionController::class, "update"]);
        $route->addRoute("GET", '/{solution}/delete', [SolutionController::class, "delete"]);
        $route->addGroup('/categories', function ($route) {
            $route->addRoute("GET", '', [CategorieController::class, "index"]);
            $route->addRoute("POST", '/store', [CategorieController::class, "store"]);
            $route->addRoute("POST", '/{category}/update', [CategorieController::class, "update"]);
            $route->addRoute("GET", '/{category}/delete', [CategorieController::class, "delete"]);
            $route->addRoute("GET", '/{category}/lock', [CategorieController::class, "lock"]);
            $route->addRoute("GET", '/{category}/unlock', [CategorieController::class, "unlock"]);
        });
        $route->addGroup('/scategories', function ($route) {
            $route->addRoute("GET", '', [SubCategoryController::class, "index"]);
            $route->addRoute("POST", '/store', [SubCategoryController::class, "store"]);
            $route->addRoute("POST", '/{scategory}/update', [SubCategoryController::class, "update"]);
            $route->addRoute("GET", '/{scategory}/delete', [SubCategoryController::class, "delete"]);
        });
        $route->addGroup('/timeline', function ($route) {
            $route->addRoute("GET", '', [TimelineController::class, "index"]);
            $route->addRoute("POST", '/store', [TimelineController::class, "store"]);
            $route->addRoute("POST", '/{element}/update', [TimelineController::class, "update"]);
            $route->addRoute("GET", '/{element}/delete', [TimelineController::class, "delete"]);
        });
    });
    $route->addGroup('/products', function ($route) {
        $route->addRoute("GET", '', [ProductController::class, "index"]);
        $route->addRoute("POST", '/store', [ProductController::class, "store"]);
        $route->addRoute("POST", '/{product}/update', [ProductController::class, "update"]);
        $route->addRoute("GET", '/{product}/delete', [ProductController::class, "delete"]);
        $route->addGroup('/categories', function ($route) {
            $route->addRoute("GET", '', [\App\Http\Controllers\backend\Products\CategorieController::class, "index"]);
            $route->addRoute("POST", '/store', [\App\Http\Controllers\backend\Products\CategorieController::class, "store"]);
            $route->addRoute("POST", '/{category}/update', [\App\Http\Controllers\backend\Products\CategorieController::class, "update"]);
            $route->addRoute("GET", '/{category}/delete', [\App\Http\Controllers\backend\Products\CategorieController::class, "delete"]);
        });
        $route->addGroup('/scategories', function ($route) {
            $route->addRoute("GET", '', [\App\Http\Controllers\backend\Products\SubCategoryController::class, "index"]);
            $route->addRoute("POST", '/store', [\App\Http\Controllers\backend\Products\SubCategoryController::class, "store"]);
            $route->addRoute("POST", '/{scategory}/update', [\App\Http\Controllers\backend\Products\SubCategoryController::class, "update"]);
            $route->addRoute("GET", '/{scategory}/delete', [\App\Http\Controllers\backend\Products\SubCategoryController::class, "delete"]);
        });
    });
    $route->addGroup('/services', function ($route) {
        $route->addRoute("GET", '', [ServiceController::class, "index"]);
        $route->addRoute("GET", '/create', [ServiceController::class, "create"]);
        $route->addRoute("POST", '/store', [ServiceController::class, "store"]);
        $route->addRoute("POST", '/{service}/update', [ServiceController::class, "update"]);
        $route->addRoute("GET", '/{service}/delete', [ServiceController::class, "delete"]);
        $route->addGroup('/categories', function ($route) {
            $route->addRoute("GET", '', [CategoryController::class, "index"]);
            $route->addRoute("POST", '/store', [CategoryController::class, "store"]);
            $route->addRoute("POST", '/{category}/update', [CategoryController::class, "update"]);
            $route->addRoute("GET", '/{category}/delete', [CategoryController::class, "delete"]);
        });
    });

});

