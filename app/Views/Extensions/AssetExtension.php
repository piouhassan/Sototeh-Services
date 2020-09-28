<?php


namespace App\Views\Extensions;




use App\Http\Handlers\Url\Baseurl;

class AssetExtension extends  \Twig_Extension
{
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('asset', [$this , 'asset'], ['is_safe' => ['html']])
        ];
    }


    public function asset($value)
    {
        $h = new Baseurl();
        return $h->baseurl."/public/".$value;
    }

}