<?php


namespace App\Http\Controllers\backend\Products;


use App\Views\View;
use Akuren\Auth\Auth;
use Akuren\FileValidate;
use App\Models\PCategory;
use App\Models\PSubCategory;
use App\Models\SSubCategory;
use Zen\Validation\Validator;
use App\Http\Controllers\Controller;
use Akuren\PasswordHash\CryptChecker;
use Akuren\File\UploadPicture\Picture;
use Psr\Http\Message\ServerRequestInterface;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::authentificable();
    }

    public function index()
    {
        $subCategories = PSubCategory::all();
        $categories = PCategory::all();
        return View::render('backend.products.scategories', compact('categories', 'subCategories'));
    }

    public function store(ServerRequestInterface $request)
    {
        if (is_ajax()) {
            $file = $request->getUploadedFiles()['cover'];
            $validator = (new Validator($this->getParams($request), [
                'title' => 'required|notEmpty',
                'p_category_id' => 'required|notEmpty|integer',
                'description' => 'required|notEmpty'
            ]))->validate();
            if ($validator->isValid() && FileValidate::validate($file) === true) {
                $pictureName = Picture::to()->upload($file);
                $path = '/uploads/'.$pictureName;
                $category = PCategory::whereId($request->getParsedBody()['p_category_id'])->first();
                PSubCategory::create([
                    'title' => $request->getParsedBody()['title'],
                    'p_category_id' => $request->getParsedBody()['p_category_id'],
                    'cover' => $path,
                    'description' => $request->getParsedBody()['description'],
                    'hash' => $category->hash,
                    'sub_hash' => sha1($request->getParsedBody()['title'])
                ]);
                success();
            } else {
                error(array_merge($validator->errors()->toArray(), [
                    'cover' => FileValidate::validate($file)
                ]));
            }
        }
        return View::error();
    }

    public function update(ServerRequestInterface $request)
    {
        if (is_ajax()){
            $file = $request->getUploadedFiles()['cover'];
            $validator = (new Validator($this->getParams($request), [
                'title' => 'required|notEmpty',
                'p_category_id' => 'required|notEmpty|integer',
                'description' => 'required|notEmpty'
            ]))->validate();
            if (!empty($file->getClientFilename())) {
                if ($validator->isValid() && FileValidate::validate($file) === true) {
                    $pictureName = Picture::to()->upload($file);
                    $path = '/uploads/'.$pictureName;
                    PSubCategory::where('id', $request->getAttribute('scategory'))->update([
                        'title' => $request->getParsedBody()['title'],
                        'p_category_id' => $request->getParsedBody()['p_category_id'],
                        'cover' => $path,
                        'description' => $request->getParsedBody()['description'],
                    ]);
                    success();
                } else {
                    error(array_merge($validator->errors()->toArray(), [
                        'cover' => FileValidate::validate($file)
                    ]));
                }
            } else {
                if ($validator->isValid()) {
                    PSubCategory::where('id', $request->getAttribute('scategory'))->update([
                        'title' => $request->getParsedBody()['title'],
                        'p_category_id' => $request->getParsedBody()['p_category_id'],
                        'description' => $request->getParsedBody()['description'],
                    ]);
                    success();
                } else {
                    error($validator->errors()->toArray());
                }
            }
        }
        return View::error();
    }

    public function delete(ServerRequestInterface $request)
    {
        if (is_ajax()) {
            $category = PSubCategory::destroy($request->getAttribute('scategory'));
            if ($category) { success(); } else { error();}
        } else {
            PSubCategory::destroy($request->getAttribute('scategory'));
            return redirect('/admin/products/categories');
        }
    }

}