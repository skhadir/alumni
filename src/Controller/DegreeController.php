<?php


namespace App\Controller;


use App\Entity\Degree;
use App\Repository\DegreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DegreeController extends AbstractController
{
    /**
     * @Route("/formations", name="formations.index")
     */

    public function index(DegreeRepository $degreeRepository)
    {
        $degrees = $degreeRepository->findAll();

        return $this->render('formations.html.twig', ['degrees'=>$degrees]);
    }

    /**
     * @Route("/formation/{id}", name="formation.index")
     */

    public function show(Degree $degree)
    {
        return $this->render('formation.html.twig', ['degree'=>$degree]);
    }
}