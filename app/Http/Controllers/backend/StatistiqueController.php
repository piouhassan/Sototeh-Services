<?php

namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;
use App\Views\View;

class StatistiqueController extends Controller
{


    public function index()
    {
        return View::render('backend.statistiques');
    }
}