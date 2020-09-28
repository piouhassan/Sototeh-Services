<?php
/**
 * Created by PhpStorm.
 * User: Stephane
 * Date: 08/09/2019
 * Time: 15:53
 */

namespace Akuren\Gens;


class MakeFile
{

    public static function make(string $path,string $filename)
    {
    if ( fopen("$path$filename", 'w')){
        return true;
    }else{
      return false;
    }
    }

}