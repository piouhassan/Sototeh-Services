<?php


namespace Akuren\PasswordHash;


interface CryptingInterface
{

    /**
     * Hash the given value.
     *
     * @param  string $value
     * @return string
     */
    public static function make($value);

    /**
     * Check the given plain value against a hash.
     *
     * @param  string $value
     * @param  string $hashedValue
     * @return bool
     */
    public  static function check($value, $hashedValue);



}