<?php


namespace App\Http\Controllers\backend\Solutions;


use App\Views\View;
use Akuren\Auth\Auth;
use Akuren\FileValidate;
use App\Models\SCategory;
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
        $subCategories = SSubCategory::all();
        $categories = SCategory::all();
        return View::render('backend.solutions.scategories', compact('categories', 'subCategories'));
    }

    public function store(ServerRequestInterface $request)
    {
        if (is_ajax()) {
            $file = $request->getUploadedFiles()['cover'];
            $validator = (new Validator($this->getParams($request), [
                'title' => 'required|notEmpty',
                's_category_id' => 'required|notEmpty|integer',
                'description' => 'required|notEmpty'
            ]))->validate();
            if ($validator->isValid() && FileValidate::validate($file) === true) {
                $pictureName = Picture::to()->upload($file);
                $path = '/uploads/'.$pictureName;
                $scategory = SCategory::whereId($request->getParsedBody()['s_category_id'])->first();
                SSubCategory::create([
                    'title' => $request->getParsedBody()['title'],
                    's_category_id' => $request->getParsedBody()['s_category_id'],
                    'cover' => $path,
                    'sub_hash' => sha1($request->getParsedBody()['title']),
                    'hash' => $scategory->hash,
                    'description' => $request->getParsedBody()['description'],
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
                's_category_id' => 'required|notEmpty|integer',
                'description' => 'required|notEmpty',
            ]))->validate();
            if (!empty($file->getClientFilename())) {
                if ($validator->isValid() && FileValidate::validate($file) === true) {
                    $pictureName = Picture::to()->upload($file);
                    $path = '/uploads/'.$pictureName;
                    SSubCategory::where('id', $request->getAttribute('scategory'))->update([
                        'title' => $request->getParsedBody()['title'],
                        's_category_id' => $request->getParsedBody()['s_category_id'],
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
                    SSubCategory::where('id', $request->getAttribute('scategory'))->update([
                        'title' => $request->getParsedBody()['title'],
                        's_category_id' => $request->getParsedBody()['s_category_id'],
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
            $category = SSubCategory::destroy($request->getAttribute('scategory'));
            if ($category) { success(); } else { error();}
        } else {
            SSubCategory::destroy($request->getAttribute('scategory'));
            return redirect('/admin/solutions/categories');
        }
    }

}