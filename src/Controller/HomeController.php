<?php

namespace App\Controller;

use App\Repository\PracticeRepository;
use App\Repository\TestimonialRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class HomeController extends AbstractController
{
    #[Route('', name: 'app_home')]
    /* public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    } */

    public function index(PracticeRepository $practiceRepository, TestimonialRepository $testimonialRepository): Response
    {

        $practices = $practiceRepository->findAll();
        $testimonials = $testimonialRepository->findAll();

        return $this->render('home/index.html.twig', [
            'practices' => $practices,
            'testimonials' => $testimonials,
        ]);
    }

    
}
