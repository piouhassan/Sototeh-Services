<?php


namespace App\Http\Controllers\backend\Products;


use App\Views\View;
use Akuren\Auth\Auth;
use App\Models\Product;
use Akuren\FileValidate;
use App\Models\PSubCategory;
use Zen\Validation\Validator;
use App\Http\Controllers\Controller;
use Akuren\File\UploadPicture\Picture;
use Psr\Http\Message\ServerRequestInterface;

class ProductController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Auth::authentificable();
    }

    public function index()
    {
        $products = Product::all();
        $subCategories = PSubCategory::all();
        return View::render('backend.products.index', compact('products', 'subCategories'));
    }

    public function store(ServerRequestInterface $request)
    {
        if (is_ajax()) {
            $file = $request->getUploadedFiles()['cover'];
            $validator = (new Validator($this->getParams($request), [
                'title' => 'required|notEmpty',
                'p_sub_category_id' => 'required|integer',
                'content' => 'required|notEmpty',
            ]))->validate();
            if ($validator->isValid() && FileValidate::validate($file) === true) {
                $pictureName = Picture::to()->upload($file);
                $path = '/uploads/'.$pictureName;
                $psubcategory = PSubcategory::whereId($request->getParsedBody()['p_sub_category_id'])->first();
                Product::create([
                    'title' => $request->getParsedBody()['title'],
                    'p_sub_category_id' => $request->getParsedBody()['p_sub_category_id'],
                    'content' => $request->getParsedBody()['content'],
                    'cover' => $path,
                    'hash' => $psubcategory->sub_hash
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
                'p_sub_category_id' => 'required|integer',
                'content' => 'required|notEmpty',
            ]))->validate();
            if (!empty($file->getClientFilename())) {
                if ($validator->isValid() && FileValidate::validate($file) === true) {
                    $pictureName = Picture::to()->upload($file);
                    $path = '/uploads/'.$pictureName;
                    Product::where('id', $request->getAttribute('product'))->update([
                        'title' => $request->getParsedBody()['title'],
                        'p_sub_category_id' => $request->getParsedBody()['p_sub_category_id'],
                        'content' => $request->getParsedBody()['content'],
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
                    Product::where('id', $request->getAttribute('product'))->update([
                        'title' => $request->getParsedBody()['title'],
                        'p_sub_category_id' => $request->getParsedBody()['p_sub_category_id'],
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
            $category = Product::destroy($request->getAttribute('product'));
            if ($category) { success(); } else { error();}
        } else {
            Product::destroy($request->getAttribute('product'));
            return redirect('/admin/solutions/products');
        }
    }

}