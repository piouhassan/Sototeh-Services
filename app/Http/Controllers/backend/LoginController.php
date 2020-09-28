<?php /** @noinspection ALL */


namespace App\Http\Controllers\backend;

use Akuren\PasswordHash\CryptChecker;
use Akuren\Session\Flash;
use Akuren\Session\Session;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Views\View;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zen\Validation\Validator;

class LoginController extends Controller
{

    public function loginForm(ServerRequestInterface $request, ResponseInterface $response)
    {
        return View::render('backend.auth.login');
    }

    public function login(ServerRequestInterface $request)
    {
        $validator = (new Validator($request->getParsedBody(), [
            'username' => 'required|notEmpty',
            'password' => 'required|notEmpty',
        ]))->validate();
        if (is_ajax()) {
            if ($validator->isValid()) {
                $user = User::whereUsername($request->getParsedBody()['username'])->first();
                if ($user && CryptChecker::check($request->getParsedBody()['password'], $user->password)) {
                    if($user->actif === 1) {
                        (new Session())->set('auth', $user);
                        success();
                    } else {
                        error(['msg' => "Vous avez été bloquer"]);
                    }
                } else {
                    error();
                }
            }  else {
                error();
            }
        } else {
            if ($validator->isValid()) {
                $user = User::whereUsername($request->getParsedBody()['username'])->first();
                if ($user && CryptChecker::check($request->getParsedBody()['password'], $user->password)) {
                    (new Session())->set('auth', $user);
                    redirect('/admin/dashboard');
                } else {
                    (new Session())->set('error', 'Identifiant ou mot de passe incorrete');
                    redirect('/admin/auth/login');
                }
            }  else {
                (new Session())->set('error', 'Identifiant ou mot de passe incorrete');
                redirect('/admin/auth/login');
            }
        }

    }

    public function logout(ServerRequestInterface $request, ResponseInterface $response)
    {
        (new Session())->delete('auth');
        (new Session())->set('info', 'Vous êtes déconnecter avec success');
        redirect('/admin/login');
    }

}