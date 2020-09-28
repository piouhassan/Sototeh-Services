<?php
/**
 * Created by PhpStorm.
 * User: Stephane
 * Date: 08/09/2019
 * Time: 15:44
 */

namespace Akuren\Gens;


use App\Http\Handlers\Url\Baseurl;

class MakeController
{

    private $path;


    /**
     * @return string
     */
    public function setPath()
    {
        $this->path = dirname($_SERVER['DOCUMENT_ROOT']).'/app/Http/Controllers/backend/';
        return $this->path;
    }


    /**
     * @param string $filename
     * @return bool
     */
    private function make(string $filename)
    {
        if ( MakeFile::make($this->setPath(),$filename.'Controller.php')){
            return true;
        }
        else{
            return false;
        }
    }

    public function write($filename)
    {
        $text = "<?php

namespace App\Http\Controllers\backend;


use App\Http\Controllers\Controller;

class ".$filename."Controller extends Controller
{

}";
        if ($this->make($filename)){
        $handle = fopen($this->setPath().$filename.'Controller.php', 'a+');
        if  ($handle !== false) {
            fwrite($handle, $text);
            fclose($handle);
        }
        }

    }

}