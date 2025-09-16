<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/practices')]
final class AdminPracticesController extends AbstractController
{
    #[Route('', name: 'admin_practices_index')]
    public function index(): Response
    {
        return $this->render('admin_practices/index.html.twig', [
            'controller_name' => 'AdminPracticesController',
        ]);
    }
}
