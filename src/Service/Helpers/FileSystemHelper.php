<?php

namespace App\Service\Helpers;

use App\Service\Avatar\SvgAvatarFactory;

class FileSystemHelper {



    public function write(string $path, string $content) {

        $folders = substr($path, 0, strrpos($path, '/'));
        $this->checkAndCreateFolders($folders);

        $file = fopen($path, 'w');
        fwrite($file, $content);
        fclose($file);

    }

    public function checkAndCreateFolders(string $path) {

        if(!is_dir($path)){
            mkdir($path, 755, true);
        }
    }

}