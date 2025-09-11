<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Form\AdminReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route('/admin/appointment')]
final class AdminAppointmentController extends AbstractController

{
    #[Route('', name: 'admin_appointment')]
    public function index(): Response
    {
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
        $em->persist($reservation);
        $em->flush();

        $this->addFlash('success', 'Rendez-vous créé avec succès.');
        return $this->redirectToRoute('admin_appointment_index');
    }

    return $this->render('admin_appointment/add_reservation.html.twig', [
        'form' => $form->createView(),
    ]);
}

}
