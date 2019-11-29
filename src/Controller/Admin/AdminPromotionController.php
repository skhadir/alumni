<?php

namespace App\Controller\Admin;

use App\Entity\Promotion;
use App\Form\PromotionFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPromotionController extends AbstractController{

    /**
     * @Route("/admin/promotion/new", name="admin.promotion.new")
     */

    public function new(Request $request)
    {
        $form = $this->createForm(PromotionFormType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $promotion = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($promotion);
            $manager->flush();

            $this->addFlash('success', 'Promotion ajoutée avec succès !');

            return $this->redirectToRoute('admin.index', [
                '_fragment' => 'promotion'
            ]);
        }

        return $this->render('admin/promotion/new.html.twig', [
            'form' =>$form->createView()
        ]);
    }

    /**
     * @Route("/admin/promotion/{id}/edit", name="admin.promotion.edit")
     */

    public function edit(Promotion $promotion, Request $request)
    {
        $form = $this->createForm(PromotionFormType::class, $promotion);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager = $this->getDoctrine()->getManager();
            $manager->flush();

            $this->addFlash('success', 'Promotion modifiée avec succès !');

            return $this->redirectToRoute('admin.index', [
                '_fragment' => 'promotion'
            ]);
        }

        return $this->render('admin/promotion/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("admin/promotion/{id}/delete", name="admin.promotion.delete")
     */

    public function remove(Promotion $promotion)
    {
        $id = 'promotion-'. $promotion->getId();

        $manager = $this->getDoctrine()->getManager();
        $manager->remove($promotion);
        $manager->flush();

        $this->addFlash('success', 'Promotion supprimée avec succès');

        return $this->json($id);
    }

    /**
     * @Route("admin/promotion/{id}", name="admin.promotion.show")
     */

    public function show(Promotion $promotion)
    {
        return $this->render('admin/promotion/promotion.html.twig', ['promotion'=>$promotion]);
    }
}

