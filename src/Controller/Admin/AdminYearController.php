<?php

namespace App\Controller\Admin;

use App\Entity\Year;
use App\Form\YearFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminYearController extends AbstractController {

    /**
     * @Route("/admin/year/new", name="admin.year.new")
     */

    public function new(Request $request) {

        $form = $this->createForm(YearFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $year = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($year);
            $manager->flush();
            $this->addFlash('success', 'Nouvelle année créee');
            return $this->redirectToRoute('admin.index', [
                '_fragment' => 'year'
            ]);
        }
        return $this->render('admin/year/new.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin/year/{id}/edit", name="admin.year.edit")
     */

    public function edit(Year $year, Request $request){

        $form = $this->createForm(YearFormType::class, $year);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            $this->addFlash('success', 'Année modifiée');
            return $this->redirectToRoute('admin.index', [
                '_fragment' => 'year'
            ]);
        }


        return $this->render('admin/year/edit.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin/year/{id}/remove", name="admin.year.remove")
     */
    public function remove(Year $year, Request $request)
    {
        $id = 'year-'. $year->getId();

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($year);
        $manager->flush();
        $this->addFlash('success', 'Année supprimée');

        return $this->json($id);

    }

}

