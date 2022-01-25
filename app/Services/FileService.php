<?php

namespace App\Services;

use App\Interfaces\FileServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileService implements FileServiceInterface {

   // public function uploadFiles($files, $resource)
    public function uploadFiles($file, $project, $type)
    {
        Log::debug("entra a upload");
        if($file) {
            $name = md5(Str::random(20));
            $fileContent = base64_decode(substr($file, strpos($file, ',') + 1));
            $path = "{$type}";
            $ini = explode("/", $file);
            $fin = explode(";", $ini[1]);
            $ext = $fin[0];
    
            $fileName = $path . '/' . $name . '.'.$ext;

            Log::debug("va a storage");
            Log::debug($fileName);
            $path = Storage::disk('public')->put($fileName, $fileContent);
            Log::debug($path);
            
            Log::debug("termino storage");
            return $fileName;
    
        }
    }

}