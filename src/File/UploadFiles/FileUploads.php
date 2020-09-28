<?php
/**
 * Created by PhpStorm.
 * User: Stephane
 * Date: 01/06/2019
 * Time: 20:23
 */

namespace Akuren\File\UploadFiles;


use Psr\Http\Message\UploadedFileInterface;

class FileUploads{

    protected  $path = 'uploads';

    public function path($value){
        $this->path = $value;
        return   $this;
    }
    public function __construct(?string $path = null)
    {
        if ($path){
            $this->path = $path;
        }
    }
        public function upload(UploadedFileInterface $file, ?string  $oldFile = null) :string
    {
        $this->delete($oldFile);
        $targetPath = $this->addCopySuffix($this->path. DIRECTORY_SEPARATOR. $file->getClientFilename());
        $dirname =  pathinfo($targetPath, PATHINFO_DIRNAME);
        if (!file_exists($dirname)){
            mkdir($dirname, 777, true);
        }
         $uploaFilName = $file->getClientFilename();
        $file->moveTo($dirname . "/" . $uploaFilName);
        return pathinfo($targetPath)['basename'];
    }


    private function addCopySuffix(string  $targetPath) : string
    {
        if (file_exists($targetPath)){
            return $this->addCopySuffix($this->getPathWithSuffix($targetPath, 'copy'));
        }
        return $targetPath;
    }

        public function delete(?string  $oldFile)
    {
        if ($oldFile){
            $oldFile = $this->path.DIRECTORY_SEPARATOR.$oldFile;
            if (file_exists($oldFile)){
                unlink($oldFile);
            }
            foreach ($this->formats as $format =>$_){
                $oldFileWithFormat = $this->getPathWithSuffix($oldFile, $format);
                if (file_exists($oldFileWithFormat)){
                    unlink($oldFileWithFormat);
                }

            }
        }
    }
}