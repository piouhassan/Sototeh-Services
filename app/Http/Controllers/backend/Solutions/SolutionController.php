<?php


namespace App\Http\Controllers\backend\Solutions;


use App\Views\View;
use Akuren\Auth\Auth;
use App\Models\Solution;
use App\Models\SSubCategory;
use Zen\Validation\Validator;
use App\Http\Controllers\Controller;
use Akuren\PasswordHash\CryptChecker;
use Psr\Http\Message\ServerRequestInterface;

class SolutionController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Auth::authentificable();
    }

    public function index()
    {
        $solutions = Solution::all();
        $subCategories = SSubCategory::all();
        return View::render('backend.solutions.index', compact('solutions', 'subCategories'));
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
                's_sub_category_id' => 'required|integer',
            ]))->validate();
            $subcategory = SSubCategory::whereId($request->getParsedBody()['s_sub_category_id'])->first();
            if ($validator->isValid()) {
                Solution::create(
                    array_merge($request->getParsedBody(),
                    ['hash' => $subcategory->sub_hash])
                    );
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
                Solution::where('id', $request->getAttribute('solution'))->update($request->getParsedBody());
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
            $category = Solution::destroy($request->getAttribute('solution'));
            if ($category) { success(); } else { error();}
        } else {
            Solution::destroy($request->getAttribute('solution'));
            return redirect('/admin/solutions/solutions');
        }
    }

}