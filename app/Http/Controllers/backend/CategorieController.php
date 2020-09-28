<?php


namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;
use App\Views\View;

class CategorieController extends Controller
{


    public function index()
    {
        return View::render('backend.categories');
    }

}