<?php


namespace Akuren\Cookies;


interface CookieInterface
{

    public static function cookieName($name);

    /**
     * @return mixed
     */
    public function save();


    /**
     * @param string $name
     * @param null $defaultValue
     * @return mixed
     */
    public static function getCookie(string $name, $defaultValue = null);


    /**
     * @param string $name
     * @return mixed
     */
    public static function DeleteCookie(string $name);
}