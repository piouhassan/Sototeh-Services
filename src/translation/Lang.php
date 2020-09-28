<?php


namespace Akuren\translation;

class Lang
{
    private $langs;

    private $locale;

    public function __construct(array $langs, ?string $locale = 'fr')
    {
        $this->langs = $langs;
        $this->locale = $locale;
    }


    public function setLocale(string $locale)
    {
        $this->locale = $locale;
    }

    public function getLocale():string
    {
        return $this->locale;
    }
    /**
     * Return the message with the key
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        return $this->langs[$this->locale][$key];
    }

}