<?php

namespace App\Controller;

use App\Repository\PracticeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/practices')]
final class PracticesController extends AbstractController
{
    #[Route('', name: 'practices_index')]
    public function index(PracticeRepository $practiceRepository): Response
    {

        $practices = $practiceRepository->findAll();
        

        return $this->render('practices/index.html.twig', [
            'practices' => $practices,
            
        ]);
    }

#[Route('/practices/{id}', name: 'practice_show')]
    public function show($id,PracticeRepository $practiceRepository): Response
    {

        $practice= $practiceRepository->find($id);
        if (!$practice) {
            throw $this->createNotFoundException('Practice not found');
        }

        return $this->render('practices/show.html.twig', [
            'practice'=> $practice,

        ]);
     
    }


}
