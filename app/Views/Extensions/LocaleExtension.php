<?php


namespace App\Views\Extensions;


use Akuren\translation\Translate;
use Twig_Extension;

class LocaleExtension extends Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('locale', [$this , 'localeLanguage'], ['is_safe' => ['html']])
        ];
    }


    public function localeLanguage( string $value)
    {
      return Translate::forceLanguage($value);
    }

}