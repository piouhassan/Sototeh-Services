<?php


namespace Akuren\Session;


class FlashMessageService
{

    /**
     * @var SessionInterface
     */
    private $session;

    private  $sessionKey = 'flash';

    private  $messages ;
    /**
     * FlashMessageService constructor.
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param string $message
     */
    public function success(string $message)
    {
                $flash = $this->session->get($this->sessionKey, []);
                $flash['success'] = $message;
                $this->session->set($this->sessionKey, $flash);
    }

    public function error(string $message)
    {
        $flash = $this->session->get($this->sessionKey, []);
        $flash['error'] = $message;
        $this->session->set($this->sessionKey, $flash);
    }

    /**
     * @param string $type
     * @return null|string
     */
    public function  get(string  $type) : ?string
    {
        if (is_null($this->messages)){
           $this->messages = $this->session->get($this->sessionKey, []);
            $this->session->delete($this->sessionKey);
        }


        if (array_key_exists($type, $this->messages)){
            return $this->messages[$type];
        }
        return null;
    }
}