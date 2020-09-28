<?php
/**
 * Created by PhpStorm.
 * User: Tanza Studio
 * Date: 11/11/2018
 * Time: 14:23
 */

namespace App\Views\Extensions;


use Akuren\Session\Session;
use Twig\TwigFunction;
use Twig_Extension;

class PathExtension extends Twig_Extension
{

    public function getFunctions()
    {
        return [
            new  TwigFunction('path', [$this , 'path']),
        ];
    }

    public function path(string $path)
    {
        $lang = (new Session())->get('language');
        return '/'.$lang.$path;
    }

}