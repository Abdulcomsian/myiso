<?php

namespace App\Helpers;

class HelperFunctions
{
    public static function saveFile($path,$file){
        $imageName = uniqid().".".$file->extension();
        $imagePath = $path.$imageName;
        $file->move(public_path($path), $imageName);
        return $imagePath;
    }
}