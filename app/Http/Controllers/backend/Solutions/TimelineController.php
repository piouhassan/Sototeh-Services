<?php


namespace App\Http\Controllers\backend\Solutions;


use App\Views\View;
use Akuren\Auth\Auth;
use Akuren\FileValidate;
use App\Models\STimeline;
use App\Models\SSubCategory;
use Zen\Validation\Validator;
use App\Http\Controllers\Controller;
use Akuren\PasswordHash\CryptChecker;
use Akuren\File\UploadPicture\Picture;
use Psr\Http\Message\ServerRequestInterface;

class TimelineController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        Auth::authentificable();
    }

    public function index()
    {
        $timeline = STimeline::all();
        $subCategories = SSubCategory::all();
        return View::render('backend.solutions.timeline', compact('timeline', 'subCategories'));
    }

    public function store(ServerRequestInterface $request)
    {
        if (is_ajax()) {
            $file = $request->getUploadedFiles()['cover'];
            $validator = (new Validator($this->getParams($request), [
                'title' => 'required|notEmpty',
                'content' => 'required|notEmpty|max:500',
                's_sub_category_id' => 'required|integer',
            ]))->validate();
            if ($validator->isValid() && FileValidate::validate($file) === true) {
                $pictureName = Picture::to()->upload($file);
                $path = '/uploads/'.$pictureName;
                $subcategory = SSubCategory::whereId($request->getParsedBody()['s_sub_category_id'])->first();
                STimeline::create([
                    'title' => $request->getParsedBody()['title'],
                    'content' => $request->getParsedBody()['content'],
                    's_sub_category_id' => $request->getParsedBody()['s_sub_category_id'],
                    'cover' => $path,
                    'hash' => $subcategory->sub_hash
                ]);
                success();
            } else if($validator->isValid()) {
                $subcategory = SSubCategory::whereId($request->getParsedBody()['s_sub_category_id'])->first();
                STimeline::create([
                    'title' => $request->getParsedBody()['title'],
                    'content' => $request->getParsedBody()['content'],
                    's_sub_category_id' => $request->getParsedBody()['s_sub_category_id'],
                    'hash' => $subcategory->sub_hash
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
                'content' => 'required|notEmpty|max:200',
                's_sub_category_id' => 'required|integer',
            ]))->validate();
            if (!empty($file->getClientFilename())) {
                if ($validator->isValid() && FileValidate::validate($file) === true) {
                    $pictureName = Picture::to()->upload($file);
                    $path = '/uploads/'.$pictureName;
                    STimeline::where('id', $request->getAttribute('element'))->update([
                        'title' => $request->getParsedBody()['title'],
                        'content' => $request->getParsedBody()['content'],
                        's_sub_category_id' => $request->getParsedBody()['s_sub_category_id'],
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
                    STimeline::where('id', $request->getAttribute('element'))->update([
                        'title' => $request->getParsedBody()['title'],
                        'content' => $request->getParsedBody()['content'],
                        's_sub_category_id' => $request->getParsedBody()['s_sub_category_id'],
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
            $category = STimeline::destroy($request->getAttribute('element'));
            if ($category) { success(); } else { error();}
        } else {
            STimeline::destroy($request->getAttribute('element'));
            return redirect('/admin/solutions/solutions');
        }
    }
}