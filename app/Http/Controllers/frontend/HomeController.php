<?php

namespace App\Http\Controllers\frontend;

use Akuren\PasswordHash\CryptChecker;
use Akuren\Session\Session;
use App\Http\Controllers\Controller;
use App\Http\Handlers\Url\FileHelper;
use App\Models\Contact;
use App\Models\Newsletter;
use App\Models\PCategory;
use App\Models\Product;
use App\Models\PSubCategory;
use App\Models\SCategory;
use App\Models\SeCategory;
use App\Models\Service;
use App\Models\Solution;
use App\Models\SSubCategory;
use App\Models\STimeline;
use App\Views\View;
use Psr\Http\Message\ServerRequestInterface;

class HomeController extends  Controller
{
    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index()
    {
             $solutions = SCategory::all();
             $services = SeCategory::all();
             $produit = PCategory::all();
            return  View::render('frontend.home.home', compact("solutions", "services", "produit"));
   }

   public function contact()
    {
        $solutions = SCategory::all();
        $services = SeCategory::all();
        $produit = PCategory::all();
            return  View::render('frontend.contact.contact',compact("solutions", "services", "produit"));
   }

   public function addnewletter(ServerRequestInterface $request)
    {
        $params = $this->getParams($request);
        $email = $params['email'];
        $count = Newsletter::where(['email' => $email])->count();
        if ($count > 0){
            echo 'Email déjà abonné';
            die;
        }
        else{
            $data = [
                'email' => $email
            ];
            if (Newsletter::create($data)){
                echo "Merci d' avoir souscrit";
                die;
            }
            else{
                echo "Veuillez réessayer plutard";
                die;
            }
        }
   }

    public function addcontact(ServerRequestInterface $request)
    {
        $params = $this->getParams($request);
        $username = $params['username'];
        $email = $params['email'];
        $sujet = $params['sujet'];
        $message = $params['message'];

        $data = [
          'fullname' => $username ,
          'email' => $email,
          'sujet' => $sujet ,
          'message' => $message
        ];

        if (Contact::create($data)){
            echo "Votre Message nous est parvenue.";
            die;
        }
        else{
            echo "Veuillez réessayer plutard";
            die;
        }

   }

    public function subsolution(ServerRequestInterface $request)
    {
        $solutions = SCategory::all();
        $services = SeCategory::all();
        $produit = PCategory::all();
        $hash = $request->getAttribute('hash');
        $solutio = SCategory::where(['hash' => $hash])->first();
        $subsolution = SSubCategory::where(['hash' => $hash])->get();
        return View::render("frontend.solution.subsolution", compact("subsolution",'solutio','solutions',"produit","services"));
   }

    public function solution(ServerRequestInterface $request)
    {
        $solutions = SCategory::all();
        $services = SeCategory::all();
        $produit = PCategory::all();
        $hash = $request->getAttribute('hash');
         $single = Solution::where(['hash' => $hash])->get();
         $timeline = STimeline::where(['hash' => $hash])->get();
        return View::render("frontend.solution.solution", compact("single",'solutions',"produit","services",'timeline'));
    }


    public function scategory()
    {
        $solutions = SCategory::all();
        $services = SeCategory::all();
        $produit = PCategory::all();
        return View::render("frontend.solution.category",compact("solutions","produit","services"));

    }

    public function services(ServerRequestInterface $request){
        $solutions = SCategory::all();
        $services = SeCategory::all();
        $produit = PCategory::all();
        $hash = $request->getAttribute('hash');
        $single = Service::where(['hash' => $hash])->get();
        return View::render("frontend.service.service",compact("solutions","produit","services", "single"));
    }

    public function subproduit(ServerRequestInterface $request)
    {
        $solutions = SCategory::all();
        $services = SeCategory::all();
        $produit = PCategory::all();
        $hash = $request->getAttribute('hash');
        $prod = PCategory::where(['hash' => $hash])->first();
        $subprod = PSubCategory::where(['hash' => $hash])->get();
        return View::render("frontend.produit.category", compact("subprod",'prod','solutions',"produit","services"));
    }

    public function produit(ServerRequestInterface $request){
        $solutions = SCategory::all();
        $services = SeCategory::all();
        $produit = PCategory::all();
        $hash = $request->getAttribute('hash');
        $subprod = PSubCategory::where(['sub_hash' => $hash])->first();
        $single = Product::where(['hash' => $hash])->get();
        return View::render("frontend.produit.product",compact("solutions","produit","services", "single","subprod"));
    }

    public function produitdetail(ServerRequestInterface $request){
        $solutions = SCategory::all();
        $services = SeCategory::all();
        $produit = PCategory::all();
        $hash = $request->getAttribute('hash');
        $subprod = PSubCategory::where(['sub_hash' => $hash])->first();
        $single = Product::where(['hash' => $hash])->first();
        return View::render("frontend.produit.detail",compact("solutions","produit","services", "single","subprod"));
    }
}