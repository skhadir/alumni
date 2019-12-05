<?php

namespace App\Controller;

use App\Entity\Promotion;
use App\Repository\PromotionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PromotionController extends AbstractController
{

    /**
     * @Route("/promotions", name="promotions.index")
     */

    public function index(PromotionRepository $promotionRepository)
    {
        $promotions = $promotionRepository->findAll();

        return $this->render('promotions.html.twig', ['promotions'=>$promotions]);
    }

    /**
     * @Route("/promotion/{id}", name="promotion.index")
     */

    public function show(Promotion $promotion)
    {
        return $this->render('promotion.html.twig', [ 'promotion'=>$promotion]);
    }
}