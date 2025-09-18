<?php

namespace App\Controller;

use DateTimeImmutable;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Form\AdminReservationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route('/admin/appointment')]
final class AdminAppointmentController extends AbstractController

{
    #[Route('', name: 'admin_appointment')]
    public function index(ReservationRepository $reservationRepository): Response
    {
      
        $reservations = $reservationRepository->findAll();
        


            
        return $this->render('admin_appointment/index.html.twig', [
            'reservations' => $reservations,
            
        ]);

        return $this->render('admin_appointment/index.html.twig', [
            'controller_name' => 'AdminAppointmentController',
        ]);
    }




#[Route('/add', name: 'admin_appointment_add')]
public function add(Request $request, EntityManagerInterface $em): Response
{
    $reservation = new Reservation();

    $form = $this->createForm(AdminReservationType::class, $reservation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        
        $reservation->setCreatedAt(new DateTimeImmutable('now'));


        $em->persist($reservation);
        $em->flush();

        $this->addFlash('success', 'Rendez-vous créé avec succès.');
        return $this->redirectToRoute('admin_appointment_index');
    }

    

    return $this->render('admin_appointment/add_reservation.html.twig', [
        'form' => $form->createView(),
        'reservation' => $reservation,
    ]);
}




#[Route('/{id}/edit', name: 'admin_appointment_edit')]
public function edit(int $id, ReservationRepository $reservationRepository, Request $request, EntityManagerInterface $em): Response
{
    $reservation = $reservationRepository->find($id);

    if (!$reservation) {
        throw $this->createNotFoundException('Reservation not found');
    }

    $form = $this->createForm(AdminReservationType::class, $reservation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();
        return $this->redirectToRoute('admin_appointment_index');
    }

    return $this->render('admin/appointment/edit.html.twig', [
        'form' => $form->createView(),
        'reservation' => $reservation,
    ]);
}


#[Route('/{id}/delete', name: 'admin_appointment_delete')]
public function delete(int $id, ReservationRepository $reservationRepository, EntityManagerInterface $em): Response
{
    $reservation = $reservationRepository->find($id);

    if (!$reservation) {
        throw $this->createNotFoundException('Reservation not found');
    }

    $em->remove($reservation);
    $em->flush();
    return $this->redirectToRoute('admin_appointment_index');
}
}
