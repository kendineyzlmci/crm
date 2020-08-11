<?php


namespace App\Helper;


class Common
{
    public static function filesizecalc($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }

    public static function filetype($file)
    {
        $ext = pathinfo($file);
        $img = url('/backend/images/default_'.$ext['extension'].'.png');
        if(file_exists($img)){
            return url('/backend/images/default_file.png');
        }else{
            return $img;
        }
    }

}