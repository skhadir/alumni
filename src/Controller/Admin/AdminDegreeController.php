<?php

namespace App\Controller\Admin;

use App\Entity\Degree;
use App\Form\DegreeFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminDegreeController extends AbstractController {

    /**
     * @Route("/admin/degree/new", name="admin.degree.new")
     */

    public function new(Request $request) {

        $form = $this->createForm(DegreeFormType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $degree = $form->getData();
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($degree);
            $manager->flush();
            $this->addFlash('success', 'Nouvelle formation créee');
            return $this->redirectToRoute('admin.index', [
                '_fragment' => 'formation'
            ]);
        }
        return $this->render('admin/degree/new.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin/degree/{id}/edit", name="admin.degree.edit")
     */

    public function edit(Degree $degree, Request $request){

        $form = $this->createForm(DegreeFormType::class, $degree);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager = $this->getDoctrine()->getManager();
            $manager->flush();
            $this->addFlash('success', 'Formation modifiée');
            return $this->redirectToRoute('admin.index', [
                '_fragment' => 'formation'
            ]);
        }


        return $this->render('admin/degree/edit.html.twig', [
            'form'=> $form->createView()
        ]);
    }

    /**
     * @Route("/admin/degree/{id}/remove", name="admin.degree.remove")
     */
    public function remove(Degree $degree)
    {
        $id = 'degree-'. $degree->getId();

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($degree);
        $manager->flush();
        $this->addFlash('success', 'Formation supprimée');

        return $this->json($id);

    }

}