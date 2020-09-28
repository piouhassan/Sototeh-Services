<?php


namespace App\Http\Controllers;


use AkConfig\App;
use Akuren\Auth\Auth;
use Akuren\Cookies\Cookie;
use App\Views\View;
use Psr\Http\Message\ServerRequestInterface;


abstract class Controller
{

    public function __construct()
    {
         Auth::checkAuth();
    }

    /**
     * @param ServerRequestInterface $request
     * @return array
     */
    public function getParams(ServerRequestInterface $request) : array
    {
        $params = array_merge( $request->getParsedBody(), $request->getUploadedFiles());
        return $params;
    }



}