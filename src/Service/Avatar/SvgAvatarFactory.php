<?php

namespace App\Service\Avatar;
use App\Service\Tools\ColorTools;

class SvgAvatarFactory {

    const AVATAR_DIR='avatar';
    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function getAvatar(int $nbcolors, int $size) {
        $matrix = new AvatarMatrix();
        $matrix->setColors(ColorTools::getRandomColors($nbcolors));
        $matrix->setSize($size);

        $svgAvatarRenderer = new SvgAvatarRenderer($this->template);

        $svg = $svgAvatarRenderer->render($matrix);

        return $svg;
    }
}