<?php


namespace Akuren;

use Psr\Http\Message\UploadedFileInterface;

class FileValidate
{


    public static function validate(UploadedFileInterface $file)
    {
        if ($file !== null && $file->getError() === UPLOAD_ERR_OK) {
            $extension = mb_strtolower(pathinfo($file->getClientFilename(), PATHINFO_EXTENSION));
            if (in_array($extension, ['jpg', 'png', 'jpeg'])) {
                if ($file->getSize() < 2000000) {
                    return true;
                } else {
                   return "La taille de la photo doit être inférieur à 2 mo";
                }
            } else {
                return "Le format de la photo n'est pas valide (jpg, jpeg, png)";
            }
        } else {
            return "La photo n'est pas valide";
        }
    }

}