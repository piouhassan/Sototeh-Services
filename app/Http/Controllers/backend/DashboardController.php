<?php


namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
use App\Models\Solution;
use App\Models\User;
use App\Views\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DashboardController extends Controller
{

    public function index()
    {
        $userCount = User::all()->count();
        $solutionCount = Solution::all()->count();
        $serviceCount = Service::all()->count();
        $produitCount = Product::all()->count();
        return View::render('backend.dashboard', compact('userCount', 'solutionCount', 'serviceCount', 'produitCount'));
    }

}