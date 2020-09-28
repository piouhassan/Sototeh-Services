<?php

namespace App\Views;


use AkConfig\config\Config;
use Akuren\Session\FlashMessageService;
use Akuren\Session\Session;
use App\Views\Extensions\AssetExtension;
use App\Views\Extensions\AuthExtension;
use App\Views\Extensions\FlashExtension;
use App\Views\Extensions\FlashMessageExtension;
use App\Views\Extensions\FormExtension;
use App\Views\Extensions\HtmlExtension;
use App\Views\Extensions\LanguageExtension;
use App\Views\Extensions\LocaleExtension;
use App\Views\Extensions\MarkdownExtension;
use App\Views\Extensions\PathExtension;
use App\Views\Extensions\RouteLinkExtension;
use App\Views\Extensions\SubstrExtension;
use Psr\Http\Message\ResponseInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;
use Zend\Diactoros\Response;



class View
{
    protected $twig;


    /**
     * @param $view
     * @param array $data
     * @return ResponseInterface
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public  static function render($view, array $data = []) : ResponseInterface
    {
        $response = new Response();
        $view = implode('/', explode('.', $view)) . '.twig';
         $folders = __DIR__.'/../../templates';
        $loader = new Twig_Loader_Filesystem($folders);
        $twig = new  Twig_Environment($loader, [
            'cache' =>  false //__DIR__.'/../../common/cache',
        ]);

        $twig->addExtension(new MarkdownExtension());

        $twig->addExtension(new FormExtension());

        $twig->addExtension(new AssetExtension());

        $flash = new FlashMessageService(new Session());

        $twig->addExtension(new FlashMessageExtension($flash));

        $twig->addExtension(new LanguageExtension());

        $twig->addExtension(new LocaleExtension());
        $twig->addExtension(new FlashExtension());
        $twig->addExtension(new PathExtension());
        $twig->addExtension(new AuthExtension());

        $twig->addExtension(new RouteLinkExtension());

        $twig->addExtension(new HtmlExtension());

             $response->getBody()->write($twig->render($view, $data));
             return $response;
    }

    /**
     * @param array $data
     * @return ResponseInterface
     */
    public static function Json(array $data = []) : ResponseInterface
    {
        $response = new Response();
        $response->getBody()->write(json_encode($data));
        return $response->withStatus(202);
    }


    public static function error() :ResponseInterface{
        $response = new Response();
        $response->getBody()->write(Config::NotFound());
        return $response->withStatus(404);
     }


}