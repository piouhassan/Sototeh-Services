<?php
/**
 * Created by PhpStorm.
 * User: Stephane De Jesus
 * Date: 20/12/2019
 * Time: 11:28
 */

namespace Akuren\File\UploadFiles;


class Files extends FileUploads
{

    public static function to(){
    return new FileUploads();
    }
}