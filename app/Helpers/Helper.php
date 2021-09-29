<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Helper
{
    public static function upload_file($file, $old_file=null){
        if (!is_null($old_file)){
            if(file_exists(public_path() .'/uploads/'.$old_file)){
                unlink(public_path() .'/uploads/'.$old_file);
            }
        }

        $random=Str::random(5);
        $name = time().$random.'.'.$file->extension();
        $file->move(public_path().'/uploads/', $name);
        return $name;
    }

    public static function upload_files($files, $old_files=null){
        if (!is_null($old_files)){
            $old_files=json_decode($old_files, true);
            if (count($old_files)){
                foreach ($old_files as $old_file){
                    if(file_exists(public_path() .'/uploads/'.$old_file)){
                        unlink(public_path() .'/uploads/'.$old_file);
                    }
                }
            }
        }

        $data=[];

        if (count($files)){
            foreach ($files as $file){
                $name = time().'.'.$file->extension();
                $file->move(public_path().'/uploads/', $name);
                $data[]=$name;
            }
        }

        return json_encode($data);
    }


}
