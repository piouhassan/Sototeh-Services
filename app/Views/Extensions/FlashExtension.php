<?php


namespace App\Views\Extensions;




use Akuren\Session\Session;

class FlashExtension extends  \Twig_Extension
{
    private $session;
    public function __construct()
    {
        $this->session = new Session();
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('flash', [$this , 'flash']),
            new \Twig_SimpleFunction('get_flash', [$this , 'get_flash']),
        ];
    }

    public function flash(string $key)
    {
        if (!is_null($this->session->get($key))) {
            return true;
        }
        return false;
    }

    public function get_flash(string $key)
    {
        $content = $this->session->get($key);
        $this->session->delete($key);
        if (!is_null($content)) {
            return $content;
        }
    }



}