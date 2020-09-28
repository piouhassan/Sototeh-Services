<?php


namespace Akuren\Cookies;


class Cookies implements CookieInterface
{

    private $name;
    private $value;
    private $expire;
    private $path;
    private $domain;
    private $secure;
    private $httpOnly;



    public static function cookieName ($name)
    {
            return (new Cookies())->setName($name);
    }



    /**
     * @param string $name
     * @param null $defaultValue
     * @return mixed
     */
    public static function getCookie (string $name,$defaultValue = null)
    {
        if (isset($_COOKIE[$name])) {
            return $_COOKIE[$name];
        }
        else {
            return $defaultValue;
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    public static function DeleteCookie (string $name)
    {
        if (self::getCookie($name)) {
             unset($_COOKIE[$name]);
        }
        else {
            return null;
        }
    }


    /**
     * @param mixed $name
     * @return Cookies
     */
    public function setName ($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param mixed $value
     * @return Cookies
     */
    public function setValue ($value)
    {
        $this->value = $value;
        return $this;
    }


    /**
     * @param mixed $expire
     * @return Cookies
     * @throws \Exception
     */
    public function setExpire ($expire)
    {
        $this->expire = time()  + (3600 * 24) * self::isExpiryTimeValid($expire);
        return $this;
    }


    /**
     * @param mixed $path
     * @return Cookies
     */
    public function setPath ($path)
    {
        $this->path = $path;
        return $this;
    }


    /**
     * @param mixed $domain
     * @return Cookies
     */
    public function setDomain ($domain)
    {
        $this->domain = self::normalizeDomain($domain);
        return $this;
    }


    /**
     * @param mixed $secure
     * @return Cookies
     */
    public function setSecure ($secure)
    {
        $this->secure = $secure;
        return $this;
    }

    /**
     * @param mixed $httpOnly
     * @return Cookies
     */
    public function setHttpOnly ($httpOnly)
    {
        $this->httpOnly = $httpOnly;
        return $this;
    }



    private static function normalizeDomain($domain = null) {

        $domain = (string) $domain;

        if ($domain === '') {

            return null;
        }


        if (\filter_var($domain, \FILTER_VALIDATE_IP) !== false) {

            return null;
        }


        if (\strpos($domain, '.') === false || \strrpos($domain, '.') === 0) {

            return null;
        }


        if ($domain[0] !== '.') {
            $domain = '.' . $domain;
        }

        return $domain;
    }


    private static function isNameValid($name) {
        $name = (string) $name;

        // The name of a cookie must not be empty on PHP 7+ (https://bugs.php.net/bug.php?id=69523).
        if ($name !== '' || \PHP_VERSION_ID < 70000) {
            if (!\preg_match('/[=,; \\t\\r\\n\\013\\014]/', $name)) {
                return true;
            }
        }

        return false;
    }


    private static function isExpiryTimeValid($expire) {
        if (is_int($expire)){
            return (int) $expire;
        }else{
            throw new \Exception('Cookie  Expire time  must be Numeric not Date or String');
        }

    }


    /**
     * @return mixed
     * @throws \Exception
     */
    public  function save()
    {
        if (self::isNameValid($this->name)){
            return setcookie($this->name, $this->value, $this->expire, $this->path, $this->domain, $this->secure, $this->httpOnly);
        }else{
            throw new \Exception('Cookie  is not set . Something go wrong');
        }

    }

}