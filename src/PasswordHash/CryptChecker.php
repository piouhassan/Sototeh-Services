<?php


namespace Akuren\PasswordHash;


class CryptChecker extends Bcrypt implements CryptingInterface
{
    public static function make($value)
    {
        return self::hashPassword($value);
    }

    public static function check ($value , $hashedValue)
    {
        return self::checkPassword($value,$hashedValue);
    }

}