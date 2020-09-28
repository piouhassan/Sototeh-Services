<?php


namespace Akuren\Auth;

interface AuthInterface
{

    /**
     * @param array $username
     * @param array $password
     * @return mixed
     */
    public static  function login(array  $username, array  $password);

    /**
     * @return mixed
     */
    public static function user();




}