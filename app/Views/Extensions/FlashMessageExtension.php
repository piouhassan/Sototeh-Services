<?php


namespace App\Views\Extensions;


use Akuren\Session\FlashMessageService;

class FlashMessageExtension extends \Twig_Extension
{
    /**
     * @var FlashMessageService
     */
    private $flashMessageService;

    public function __construct(FlashMessageService $flashMessageService)
    {

        $this->flashMessageService = $flashMessageService;
    }

    public function getFunctions() : array
    {
        return [
          new \Twig_SimpleFunction('flash', [$this, 'getFlash'])
        ];
}

    public function getFlash($type) : ?string
    {
        return $this->flashMessageService->get($type);
     }


}