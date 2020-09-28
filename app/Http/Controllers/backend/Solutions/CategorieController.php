<?php


namespace App\Http\Controllers\backend\Solutions;


use App\Views\View;
use Akuren\Auth\Auth;
use Akuren\FileValidate;
use App\Models\SCategory;
use Zen\Validation\Validator;
use App\Http\Controllers\Controller;
use Akuren\PasswordHash\CryptChecker;
use Akuren\File\UploadPicture\Picture;
use Psr\Http\Message\ServerRequestInterface;

class CategorieController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Auth::authentificable();
    }

    public function index()
    {
        $categories = SCategory::all();
        return View::render('backend.solutions.categories', compact('categories'));
    }

    public function store(ServerRequestInterface $request)
    {
        if (is_ajax()) {
            $file = $request->getUploadedFiles()['cover'];
            $validator = (new Validator($this->getParams($request), [
                'title' => 'required|notEmpty',
                'description' => 'required|notEmpty'
            ]))->validate();
            if ($validator->isValid() && FileValidate::validate($file) === true) {
                $pictureName = Picture::to()->upload($file);
                $path = '/uploads/'.$pictureName;
                SCategory::create([
                    'title' => $request->getParsedBody()['title'],
                    'cover' => $path,
                    'description' => $request->getParsedBody()['description'],
                    'hash' => sha1($request->getParsedBody()['title'])
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
            ]))->validate();
            if (!empty($file->getClientFilename())) {
                if ($validator->isValid() && FileValidate::validate($file) === true) {
                    $pictureName = Picture::to()->upload($file);
                    $path = '/uploads/'.$pictureName;

                    SCategory::where('id', $request->getAttribute('category'))->update([
                        'title' => $request->getParsedBody()['title'],
                        'description' => $request->getParsedBody()['description'],
                        'cover' => $path,
                    ]);
                    success();
                } else {
                    error(array_merge($validator->errors()->toArray(), [
                        'cover' => FileValidate::validate($file)
                    ]));
                }
            } else {
                if ($validator->isValid()) {
                    SCategory::where('id', $request->getAttribute('category'))->update([
                        'title' => $request->getParsedBody()['title'],
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
            $category = SCategory::destroy($request->getAttribute('category'));
            if ($category) { success(); } else { error();}
        } else {
            SCategory::destroy($request->getAttribute('category'));
            return redirect('/admin/solutions/categories');
        }
    }

}