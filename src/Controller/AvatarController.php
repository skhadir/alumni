<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;

class AvatarController extends AbstractController
{

    private $svgAvatarFactory;
    private $fileSystemHelper;

    public function __construct(SvgAvatarFactory $svgAvatarFactory, FileSystemHelper $fileSystemHelper)
    {
        $this->svgAvatarFactory = $svgAvatarFactory;
        $this->fileSystemHelper = $fileSystemHelper;
    }

    /**
     * @Route("/avatar", name="avatar.index")
     */

    public function getAvatar($uploadDir)
    {
        $svg = $this->svgAvatarFactory->getAvatar(12, 15);
        $filename = sha1(uniqid(rand())) . '.svg';
        $filePath = $uploadDir.'/'.SvgAvatarFactory::AVATAR_DIR.'/'.$filename;
        $this->fileSystemHelper->write($filePath, $svg);

        return $this->render('avatar.html.twig',['filename'=>$filename]);
    }
}