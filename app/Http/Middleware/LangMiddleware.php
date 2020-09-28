<?php


namespace App\Http\Middleware;


use Akuren\Session\Session;
use Akuren\translation\Lang;
use App\Http\Handlers\Url\Baseurl;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LangMiddleware implements  MiddlewareInterface
{

    /**
     * @var Lang
     */
    private $lang;
    /**
     * @var Session
     */
    private $session;

    public function __construct(Lang $lang, Session $session)
    {
        $this->lang = $lang;
        $this->session = $session;
    }

    /**
     * Process an incoming server request and return a response, optionally delegating
     * response creation to a handler.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process (ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $paths = explode('/', $request->getUri()->getPath());
        $path = $request->getUri()->getPath();
        if (in_array('fr', $paths)) {
            $this->session->set('language', 'fr');
        } else if (in_array('en', $paths)) {
            $this->session->set('language', 'en');
        } else {
            $this->session->set('language', 'fr');
            redirect('/fr'. $path);
        }
        if ($this->lang->getLocale() != $this->session->get('language')) {
            $path = str_replace($this->lang->getLocale(), $this->session->get('language'), $path);
            return redirect($path);
        } else {
            return $handler->handle($request);
        }
    }
}