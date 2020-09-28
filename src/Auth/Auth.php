<?php


namespace Akuren\Auth;


use Akuren\PasswordHash\CryptChecker;
use Akuren\Session\Session;
use App\Http\Handlers\Url\Baseurl;
use App\Models\User;
use Zend\Diactoros\Request;

class Auth implements AuthInterface
{



    /**
     * @param array $username
     * @param array $password
     * @return mixed
     */
    public static function login (array $username, array $password)
    {
        $tableaux = [];
        $attribute = [];
        $attributes = [];
        $tableau = [];
        foreach ( $username as $k => $v){
            $tableaux[] = "$k";
            $attribute[] = $v;
        }

        foreach ( $password as $k => $v){
            $tableau[] = "$k";
            $attributes[] = $v;
        }

        $name = implode(' ' , $tableaux);
        $nameValue  = implode(' ' , $attribute);
        $passValue = implode(',', $attributes);

        $user = User::where([$name  =>  $nameValue])->first();

        if (CryptChecker::make($passValue) ===  $user->password){
            Session::logged($user->id);
            return true;
        }
        else{
            return false;
        }

    }

    /**
     * @return mixed
     */
    public static function user ()
    {
        if (isset($_SESSION['auth'])){
            $id = $_SESSION['auth'];
            if (isset($id)){
                $user = User::where(['id'  => $id])->first();
                return $user;
            }else{
                return  false;
            }
        }

    }


    public static function checkAuth()
    {
        $session = new Session();
        $baseurl = new Baseurl();
        $url = $_SERVER['REQUEST_URI'];
        $urls =  "/".$session->get('language').'/admin';
        if (empty($session->get('auth')) && $url === $urls) {
            redirect($baseurl->baseurl.'/admin/login');
        }
        return true;
    }

    public static function authentificable()
    {
        $auth = (new Session())->get('auth');
        if ($auth) {
            $user = User::find($auth->id);
            if (is_null($user)) {
                redirect('/admin/login');
            }
        } else {
            redirect('/admin/login');
        }
    }
}