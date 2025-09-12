<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/contact')]
final class ContactController extends AbstractController
{
    /* #[Route('', name: 'contact_index')]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    #[Route('/new', name: 'contact_new')]
    public function new(Request $request, EntityManager $em): Response

    {
        $rdv = new Contact();
        $form = $this->createForm(ContactType::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($rdv);
            $em->flush();
            return $this->redirectToRoute('contact_index');
        }

        return $this->render('contact/new.html.twig', [
            'form' => $form->createView(),
        ]);
    } */


    #[Route('', name: 'contact_index')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Traitement sans email : afficher ou enregistrer
            $this->addFlash('success', 'Merci ' . $data['nom'] . ', votre message a été reçu.');

            // Tu peux aussi faire un dump pour voir les données
            // dump($data);

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}


