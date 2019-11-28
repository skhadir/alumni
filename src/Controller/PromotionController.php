<?php

namespace App\Controller;

use App\Repository\DegreeRepository;
use App\Repository\PromotionRepository;
use App\Repository\YearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Promotion;


class PromotionController extends AbstractController
{
    /**
     * @Route("/promotion", name="promotion.index")
     */

    function index(PromotionRepository $promotionRepository, DegreeRepository $degreeRepository, YearRepository $yearRepository)
    {
        $degrees = $degreeRepository->findBy([],['name' => 'ASC']);
        $years = $yearRepository->findBy([],['title' => 'ASC']);
        $promotions = $promotionRepository->getAllOrderByDegreeAndYear();

        return $this->render('admin/promotion/promotion.html.twig',
            ['degrees'=>$degrees,
                'years'=>$years,
                'promotions'=>$promotions]);
    }
}

