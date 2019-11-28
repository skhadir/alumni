<?php

namespace App\Service\Tools;

class ColorTools {

	static function getRandomColor()
    {
    	$chars = str_split('ABCDEF0123456789');
        $color = '#';
        for($i = 0 ; $i < 6 ; $i++){
            $color .= $chars[rand(0, count($chars) - 1)];
        }
        return $color;
    }

    static function getRandomColors(int $n): array
    {
    	return array_map(function(){
     		return self::getRandomColor();
        }, array_fill(0, $n, null));


        $colors = [];
        for($i = 0 ; $i < $n ; $i++){
        	$colors[] = self::getRandomColor();
        }
        return $colors;
    }

}