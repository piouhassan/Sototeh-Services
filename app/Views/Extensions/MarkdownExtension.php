<?php


namespace App\Views\Extensions;


use Michelf\MarkdownExtra;
use Twig_Extension;
use Twig_SimpleFilter;

class MarkdownExtension extends Twig_Extension
{

    public function getFunctions()
    {
        return [
          new \Twig_SimpleFunction('markdown', [$this , 'markdownParse'], ['is_safe' => ['html']])
        ];
    }

    public function markdownParse($value)
    {
        return MarkdownExtra::defaultTransform($value);
    }

}