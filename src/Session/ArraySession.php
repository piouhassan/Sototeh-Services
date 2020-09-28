<?php


namespace Akuren\Session;


class ArraySession  implements SessionInterface
{
    private  $session = [];

    /**
     * Get  information From Session
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        if (array_key_exists($key, $_SESSION)){
            return $this->session[$key];
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
        $this->session[$key] = $value;
    }

    /**
     * Delete key from Session
     * @param string $key
     */
    public function delete(string $key): void
    {
        unset($this->session[$key]);
    }
}