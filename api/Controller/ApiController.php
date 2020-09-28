<?php

namespace Api\Controller;


use App\Http\Controllers\Controller;
use App\Models\User;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;


class ApiController  extends Controller
{

    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $users = User::all();

        return $this->view->Json(compact('users'));
    }
    
}