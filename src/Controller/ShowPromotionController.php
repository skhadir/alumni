<?php
//
//namespace App\Controller;
//
//use App\Repository\DegreeRepository;
//use App\Repository\PromotionRepository;
//use App\Repository\YearRepository;
//use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\Routing\Annotation\Route;
//use App\Entity\Promotion;
//
//class ShowPromotionController extends AbstractController
//{
//    /**
//     * @Route("/promotion/{id}, name="promotioninfo.index")
//     */
//
//    public function index(PromotionRepository $promotionRepository, DegreeRepository $degreeRepository, YearRepository $yearRepository)
//    {
//        $degrees = $degreeRepository->findBy([],['name' => 'ASC']);
//        $years = $yearRepository->findBy([],['title' => 'ASC']);
//        $promotions = $promotionRepository->getAllOrderByDegreeAndYear();
//
//        return $this->render('admin/promotion/promotioninfo.html.twig',
//            ['degrees'=>$degrees,
//                'years'=>$years,
//                'promotions'=>$promotions]);
//    }
//}


