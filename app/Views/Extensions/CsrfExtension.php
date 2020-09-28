<?php


namespace App\Views\Extensions;

use Grafikart\Csrf\CsrfMiddleware;

class CsrfExtension extends \Twig_Extension
{


    public function getFunctions ()
    {
       return [
           new \Twig_SimpleFunction('csrf_input', [$this, 'csrfInput'], ['is_safe' => ['html']])
       ];
    }

    public function csrfInput ()
    {
        return  "<input type=\"hidden\" name=\"{$this->getCsrf()->getFormKey()}\" value=\"{$this->getCsrf()->generateToken()}\"/>" ;
    }

    private function getCsrf()
    {
        $csrf = new CsrfMiddleware($_SESSION, 200);

        return $csrf;
}

}