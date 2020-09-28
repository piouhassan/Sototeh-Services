<?php


namespace App\Http\Middleware;



use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TrailingSlashMiddleware implements MiddlewareInterface
{



    public function process (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $url = $request->getUri()->getPath();

           if (!empty($url)  &&  $url[-1] === "/"&& $url[0] !="/" ){
               redirect(substr($url, 0, -1));
           }

           return $handler->handle($request);
    }
}