<?php


namespace  Akuren\File\UploadPicture;

use Intervention\Image\ImageManager;
use Psr\Http\Message\UploadedFileInterface;

class Upload
{
    protected  $path = 'uploads';

    protected  $formats =  [
        'thumb' => [450 , 280]
    ];


    public function __construct(?string $path = null)
    {
        if ($path){
            $this->path = $path;
        }
    }

    /**
     * @param $value
     * @return Upload
     */
    public  function path($value){
        $this->path = $value;
        return  $this;
    }

    public  function formats($length, $height){
        $this->formats =  ['thumb' => [$length , $height]];
        return  $this;
    }

    public function upload(UploadedFileInterface $file, ?string  $oldFile = null) :string
    {
        $this->delete($oldFile);
        $targetPath = $this->addCopySuffix($this->path. DIRECTORY_SEPARATOR. $file->getClientFilename());
        $dirname =  pathinfo($targetPath, PATHINFO_DIRNAME);
        if (!file_exists($dirname)){
            mkdir($dirname, 777, true);
        }
        $file->moveTo( $targetPath);

        $this->generateFormats($targetPath);
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

    private  function getPathWithSuffix(string $path, string $suffix){
        $info = pathinfo($path);
        $destination = $info['dirname'] . DIRECTORY_SEPARATOR .$suffix . '_'  . $info['filename']  .  '.'  .$info['extension'];
        return $destination;
    }

    private function generateFormats($targetPath)
    {
        foreach ($this->formats as $format => $size){
           $destination = $this->getPathWithSuffix($targetPath, $format);
            $manager = new ImageManager(['driver' => 'gd']);
            [$width , $height] = $size;
            $manager->make($targetPath)->fit($width , $height)->save($destination);
        }
    }

}