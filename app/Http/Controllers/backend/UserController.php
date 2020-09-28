<?php


namespace App\Http\Controllers\backend;


use AkConfig\config\Config;
use Akuren\Auth\Auth;
use Akuren\Mail\Mail;
use Akuren\PasswordHash\CryptChecker;
use Akuren\Session\Session;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Views\View;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Zen\Validation\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        Auth::authentificable();
    }

    public function index()
    {
        $users = User::all();
        return View::render('backend.users.index', compact('users'));
    }

    public function create()
    {
        return View::render('backend.users.create');
    }

    public function store(ServerRequestInterface $request)
    {
        $validator = (new Validator($request->getParsedBody(), [
            'name' => 'required|notEmpty',
            'email' => 'required|email',
            'phone' => 'required|notEmpty',
            'role' => 'required|notEmpty',
            'gender' => 'required|notEmpty',
        ]))->validate();
        $user = $request->getParsedBody();
        $errors = $validator->errors()->toArray();
        $name = User::whereName($user['name'])->first();
        if ($name) {
            $errors['name'] = 'Un compte existe déja sous ce nom';
        }
        $email = User::whereEmail($user['email'])->first();
        if ($email) {
            $errors['email'] = 'Cet addresse email a été utilisé pour créer un compte';
        }
        $phone = User::wherePhone($user['phone'])->first();
        if ($phone) {
            $errors['phone'] = 'Cet numéro de téléphone a été utilisé pour créer un compte';
        }
        if (empty($errors)) {
            $user = $request->getParsedBody();
            $user['username'] = str_shuffle(implode('', explode(' ', $user['name'])));
            $user['password'] = CryptChecker::make($user['username']);
            Mail::send()
                ->setMessage('user', $user)
                ->setSubjet('Connexion Sototech-Services')
                ->setToMail($user['email'])
                ->exec();
            User::create($user);
            if (is_ajax()) {
                success([
                    'data' => $user
                ]);
            } else {
                return new Response(404, [], Config::NotFound());
            }
        } else {
            if (is_ajax()) {
                error([
                    'errors' => $errors,
                ]);
            } else {
                return new Response(404, [], Config::NotFound());
            }
        }
    }

    public function delete(ServerRequestInterface $request)
    {
        if (is_ajax()) {
            $id = $request->getAttribute('user');
            $user = User::destroy($id);
            if ($user) {
                success();
            } else {
                error();
            }
        } else {
            redirect('/admin/users');
        }
    }

    public function lock(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('user');
        $update = User::find($id)->update([
            'actif' => 0,
        ]);
        if ($update) {
            if (is_ajax()) {
                success();
            } else {
                return redirect('/admin/users');
            }
        } else {
            if (is_ajax()) {
                error();
            } else {
                return redirect('/admin/users');
            }
        }
        return redirect('/admin/users');
    }

    public function unlock(ServerRequestInterface $request)
    {
        $id = $request->getAttribute('user');
        $update = User::find($id)->update([
            'actif' => 1,
        ]);
        if ($update) {
            if (is_ajax()) {
                success();
            } else {
                return redirect('/admin/users');
            }
        } else {
            if (is_ajax()) {
                error();
            } else {
                return redirect('/admin/users');
            }
        }
        return redirect('/admin/users');
    }

}