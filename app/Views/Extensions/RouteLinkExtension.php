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

class RouteLinkExtension extends Twig_Extension
{
protected  $route;

    public function getFunctions()
    {
    return [
       new  TwigFunction('link', [$this , 'link']),
    ];
   }

    public function link($routeName)
    {
        $session = new Session();
        $urls =  "/".$session->get('language').'/';
        return   $urls.$routeName;
   }

}