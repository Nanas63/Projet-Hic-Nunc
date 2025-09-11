<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/practices')]
final class PracticesController extends AbstractController
{
    #[Route('', name: 'practices_index')]
    public function index(): Response
    {
        return $this->render('practices/index.html.twig', [
            'controller_name' => 'PracticesController',
        ]);
    }
}
