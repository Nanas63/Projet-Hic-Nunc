<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Testimonial;
use App\Form\TestimonialType;
use App\Repository\TestimonialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/testimonial')]

final class AdminTestimonialController extends AbstractController
{
    #[Route('', name: 'admin_testimonial_index')]
    public function index(\App\Repository\TestimonialRepository $testimonialRepository): Response
    {
        $testimonials = $testimonialRepository->findAll();
        
        return $this->render('admin_testimonial/index.html.twig', [
            'testimonials' => $testimonials,
            
        ]);

        
        return $this->render('admin_testimonial/index.html.twig', [
            'controller_name' => 'AdminTestimonialController',
        ]);
    }







    #[Route('/add', name: 'admin_testimonial_add')]
    public function new(Request $request, EntityManagerInterface $em, \Symfony\Bundle\SecurityBundle\Security $security): Response
    {
        $testimonial = new Testimonial();

        //Utilisateur connecté obligatoire pour laisser un témoignage//
        $user = $security->getUser();
        $testimonial->setUser($user);



        $form = $this->createForm(TestimonialType::class, $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $testimonial->setCreatedAt(new DateTimeImmutable('now'));



            $em->persist($testimonial);
            $em->flush();

            $this->addFlash('success', 'Témoignage ajouté.');
            return $this->redirectToRoute('admin_testimonial_index');
        }

        return $this->render('admin_testimonial/add.html.twig', [
            'form' => $form->createView(),
            'testimonial' => $testimonial,
        ]);
    }


    #[Route('/{id}/edit', name: 'admin_testimonial_edit')]
    public function edit(int $id, TestimonialRepository $testimonialRepository, Request $request, EntityManagerInterface $em): Response
    {
        $testimonial = $testimonialRepository->find($id);
        if (!$testimonial) {
            throw $this->createNotFoundException('Témoignage non trouvé.');
        }

        $form = $this->createForm(TestimonialType::class, $testimonial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Témoignage modifié avec succès');


            // Redirection avec l'ID pour éviter l'erreur de paramètre manquant
        /* return $this->redirectToRoute('admin_testimonial_edit', [
            'id' => $testimonial->getId(),
        ]); */
            return $this->redirectToRoute('admin_testimonial_index');
        }

        return $this->render('admin_testimonial/edit.html.twig', [
            'form' => $form->createView(),
            'testimonial' => $testimonial,
        ]);
    }

    
    #[Route('/{id}/delete', name: 'admin_testimonial_delete')]
    public function delete(int $id, TestimonialRepository $testimonialRepository, EntityManagerInterface $em): Response
    {
        $testimonial = $testimonialRepository->find($id);
        if (!$testimonial) {
            throw $this->createNotFoundException('Témoignage non trouvé.');
        }

        $em->remove($testimonial);
        $em->flush();

        $this->addFlash('success', 'Témoignage supprimé.');
        return $this->redirectToRoute('admin_testimonial_index');
    }
}
