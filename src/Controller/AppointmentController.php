<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/reservation')]
final class AppointmentController extends AbstractController

{
    #[Route('', name: 'reservation_index')]
    public function index(ReservationRepository $reservationRepository): Response
    {
        $reservation = $reservationRepository->findAll();
        return $this->render('appointment/index.html.twig', [
            'reservation' => $reservation,
        ]);
    }



    #[Route('/new', name: 'reservation_new')]
    public function new(Request $request, EntityManagerInterface $em): Response

    {
        $rdv = new Reservation();
        $form = $this->createForm(ReservationType::class, $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $rdv->setCreatedAt(new \DateTimeImmutable('now'));

            $rdv->setStatus(100);
            $em->persist($rdv);
            $em->flush();

            $this->addFlash('success', 'Votre réservation a bien été enregistrée.');
            return $this->redirectToRoute('reservation_new');
        }

        return $this->render('appointment/add_reservation.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }
}