<?php

namespace App\Controller;

use App\Repository\TestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/testimonial')]
final class TestimonialController extends AbstractController
{
    #[Route('', name: 'testimonial_index')]
    public function index(TestimonialRepository $testimonialRepository): Response
    {
        $testimonials = $testimonialRepository->findAll();

        return $this->render('testimonial/index.html.twig', [
            'testimonials' => $testimonials,
        ]);
    }

    
    #[Route('/{id}', name: 'testimonial_show')]
    public function show($id, TestimonialRepository $testimonialRepository): Response
    {
        $testimonial = $testimonialRepository->find($id);
        if (!$testimonial) {
            throw $this->createNotFoundException('Testimonial not found');
        }

        return $this->render('testimonial/index.html.twig', [
            'testimonial' => $testimonial,
        ]);
    }
}