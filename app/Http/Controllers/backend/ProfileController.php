<?php


namespace App\Http\Controllers\backend;


use Akuren\Auth\Auth;
use Akuren\File\UploadPicture\Picture;
use Akuren\PasswordHash\CryptChecker;
use Akuren\Session\Session;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Views\View;
use Psr\Http\Message\ServerRequestInterface;
use Zen\Validation\Validator;

class ProfileController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Auth::authentificable();
    }

    public function index()
    {
        return View::render('backend.users.profile');
    }

    public function update(ServerRequestInterface $request)
    {
        $auth = (new Session())->get('auth');
        $validator = (new Validator($request->getParsedBody(), [
            'email' => 'required|email',
            'phone' => 'required|notEmpty',
            'password' => 'required|notEmpty',
        ]))->validate();
        $data = $request->getParsedBody();
        $errors = $validator->errors()->toArray();
        $user = User::find($auth->id);
        if (is_ajax()) {
            if (empty($errors)) {
                if ($user && CryptChecker::check($data['password'], $user->password)) {
                    User::where('id', $auth->id)->update([
                        'email' => $data['email'],
                        'phone' => $data['phone']
                    ]);
                    success();
                } else {
                    error([
                        'errors' => ['password' => 'Mot de passe Incorrecte']
                    ]);
                }
            } else {
                error([
                    'errors' => $errors
                ]);
            }
        } else {
            return View::error();
        }



    }
    public function passwordUpdate(ServerRequestInterface $request)
    {
        $auth = (new Session())->get('auth');
        $validator = (new Validator($request->getParsedBody(), [
            'old_password' => 'required|notEmpty',
            'new_password' => 'required|notEmpty',
        ]))->addErrorsMessages([
            'old_password.required' => "L'ancien mot de passe est requis",
            'new_password.required' => "Le nouveau mot de passe est requis",
            'new_password.notEmpty' => "Vous devez renseigner le nouveau mot de passe",
            'old_password.notEmpty' => "Vous devez renseigner l'ancien mot de passe",
        ])->validate();

        $data = $request->getParsedBody();
        $errors = $validator->errors()->toArray();
        $user = User::find($auth->id);
        if (is_ajax()) {
            if (empty($errors)) {
                if ($user && CryptChecker::check($data['old_password'], $user->password)) {
                    $password  = CryptChecker::make($data['new_password']);
                    User::where('id', $user->id)->update(['password' => $password]);
                    success([
                        'test' => $password
                    ]);
                } else {
                    error([
                        'errors' => ['old_password' => 'Mot de passe Incorrecte']
                    ]);
                }
            } else {
                error([
                    'errors' => $errors
                ]);
            }
        } else {
            return View::error();
        }
    }
    public function updatePhoto(ServerRequestInterface $request)
    {
        $file = $request->getUploadedFiles()['photo'];
        if (is_ajax()) {
        if ($file !== null && $file->getError() === UPLOAD_ERR_OK) {
            $extension = mb_strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
            if (in_array($extension, ['jpg', 'png', 'jpeg'])) {
                if ($file->getSize() < 2000000) {
                    try {
                        $auth = (new Session())->get('auth');
                        $pictureName = Picture::to()->upload($file);
                        $path = '/uploads/'.$pictureName;
                        User::where('id', $auth->id)->update(['photo' => $path]);
                        success([
                            'photo' => $path
                        ]);
                    } catch (\Exception $e) {
                        error([
                            'error' => $e->getMessage()
                        ]);
                    }
                } else {
                    error([
                        'error' => "La taille de la photo doit être inférieur à 2 mo"
                    ]);
                }
            } else {
                error([
                    'error' => "Le format de la photo n'est pas valide (jpg, jpeg, png)"
                ]);
            }
        } else {
            error([
                'error' => "La photo n'est pas valide"
            ]);
        }
        } else {
            return View::error();
        }
    }
}