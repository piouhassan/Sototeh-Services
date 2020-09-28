<?php


namespace Akuren\Session;


interface SessionInterface
{

    /**
     * Get  information From Session
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null);


    /**
     * Set Information to Session
     * @param string $key
     * @param $value
     */
    public function set(string $key, $value) : void ;


    /**
     * Delete key from Session
     * @param string $key
     */
    public function delete(string $key) : void ;

}