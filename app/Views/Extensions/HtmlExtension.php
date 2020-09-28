<?php
/**
 * Created by PhpStorm.
 * User: Stephane De Jesus
 * Date: 11/01/2020
 * Time: 09:06
 */

namespace App\Views\Extensions;


class HtmlExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('htmlformat', [$this , 'htmlformat'], ['is_safe' => ['html']])
        ];
    }


    public function htmlformat($value)
    {
        return htmlspecialchars_decode($value);
    }
}