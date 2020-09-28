<?php


namespace App\Http\Controllers\backend\Services;


use Akuren\Auth\Auth;
use App\Http\Controllers\Controller;
use App\Models\SeCategory;
use App\Models\Service;
use App\Views\View;
use Psr\Http\Message\ServerRequestInterface;
use Zen\Validation\Validator;

class ServiceController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::authentificable();
    }

    public function index()
    {
        $services = Service::all();
        $categories = SeCategory::all();
        return View::render('backend.services.index', compact('services', 'categories'));
    }

    public function create()
    {
        return View::render('backend.solutions.create');
    }

    public function store(ServerRequestInterface $request)
    {
        if (is_ajax()) {
            $validator = (new Validator($this->getParams($request), [
                'title' => 'required|notEmpty',
                'se_category_id' => 'required|integer',
            ]))->validate();
            $category = SeCategory::whereId($request->getParsedBody()['se_category_id'])->first();
            if ($validator->isValid()) {
                Service::create(array_merge($request->getParsedBody(), 
                    ['hash' => $category->hash]));
                success();
            } else {
                error($validator->errors()->toArray());
            }
        }
        return View::error();
    }
    public function update(ServerRequestInterface $request)
    {
        if (is_ajax()){
            $validator = (new Validator($this->getParams($request), [
                'title' => 'required|notEmpty',
            ]))->validate();
            if ($validator->isValid()) {
                Service::where('id', $request->getAttribute('service'))->update($request->getParsedBody());
                success();
            } else {
                error($validator->errors()->toArray());
            }

        }
        return View::error();
    }

    public function delete(ServerRequestInterface $request)
    {
        if (is_ajax()) {
            $category = Service::destroy($request->getAttribute('service'));
            if ($category) { success(); } else { error();}
        } else {
            Service::destroy($request->getAttribute('service'));
            return redirect('/admin/solutions/solutions');
        }
    }

}