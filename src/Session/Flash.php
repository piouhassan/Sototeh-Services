<?php


namespace Akuren\Session;


class Flash
{

    public static function success(string $message)
    {
        return (new  FlashMessageService(new Session()))->success($message);
    }

    public static function error(string $message)
    {
        return (new  FlashMessageService(new Session()))->error($message);
    }
}