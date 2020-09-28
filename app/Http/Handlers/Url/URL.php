<?php
/**
 * Created by PhpStorm.
 * User: Stephane
 * Date: 12/07/2019
 * Time: 15:25
 */

namespace App\Http\Handlers\Url;




trait URL {
    private $url = '';
    private $current_url = '';
    public $get = '';
    public $baseurl = "";

    function __construct()
    {
        $this->url = $_SERVER['SERVER_NAME'];
        $this->current_url = $_SERVER['REQUEST_URI'];

        $clean_server = str_replace('', $this->url, $this->current_url);
        $clean_server = explode('/', $clean_server);

        $this->get = array('base_url' => "/".$clean_server[1]);

        $this->baseurl = $this->get['base_url'];
    }


}