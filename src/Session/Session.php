<?php


namespace Akuren\Session;


class Session implements SessionInterface, \ArrayAccess
{
    /**
     * Be Sure that Session  Start
     */
    private  function ensureStarted(){
      if (session_status()  === PHP_SESSION_NONE){
          session_start();
      }

    }


    public static function logged(int $authID)
    {
        (new Session())->ensureStarted();
        $auth = $_SESSION['auth'] = $authID;
        return $auth;
    }
    /**
     * Get  information From Session
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $this->ensureStarted();
       if (array_key_exists($key, $_SESSION)){
           return $_SESSION[$key];
       }
       return $default;
    }

    /**
     * Set Information to Session
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value): void
    {
        $this->ensureStarted();
       $_SESSION[$key] = $value;
    }

    /**
     * Delete key from Session
     * @param string $key
     */
    public function delete(string $key): void
    {
        $this->ensureStarted();
      unset($_SESSION[$key]);
    }

    public static function flush ()
    {
        unset($_SESSION);
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        $this->ensureStarted();
        return array_key_exists($offset, $_SESSION);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
  return $this->get($offset);
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
       $this->set($offset, $value);
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
       $this->delete($offset);
    }
}