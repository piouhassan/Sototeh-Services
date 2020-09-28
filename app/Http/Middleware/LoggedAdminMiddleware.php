<?php
/**
 * Created by PhpStorm.
 * User: Stephane De Jesus
 * Date: 18/12/2019
 * Time: 23:57
 */

namespace App\Http\Middleware;


use Akuren\Session\Session;
use App\Http\Handlers\Url\Baseurl;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoggedAdminMiddleware implements MiddlewareInterface
{

    /**
     * Process an incoming server request and return a response, optionally delegating
     * response creation to a handler.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $session = new Session();
        $baseurl = new Baseurl();
        $url = $_SERVER['REQUEST_URI'];
        $urls =  '/admin';
        if (empty($session->get('auth')) && $url === $urls) {
            redirect($baseurl->baseurl.'/login');
        }
        if(!empty($session->get('auth')) && $url === '/admin/login') {
            redirect('/admin');
        }
        return $handler->handle($request);
    }
}