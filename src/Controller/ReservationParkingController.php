<?php

namespace App\Controller;
use App\Entity\Parking;
use App\Entity\ReservationParking;
use App\Form\ReservationParkingType;
use App\Repository\ReservationParkingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Security\Core\Security;

#[Route('/reservation/parking')]
final class ReservationParkingController extends AbstractController
{
    
    
    #[Route(name: 'app_reservation_parking_index', methods: ['GET'])]
    public function index(
        ReservationParkingRepository $reservationParkingRepository,
        Request $request
    ): Response {
        $page = $request->query->getInt('page', 1);
        $limit = 11; // Nombre d'éléments par page
        
        // Récupération de toutes les réservations
        $allReservations = $reservationParkingRepository->findAll();
        $total = count($allReservations);
        
        // Calcul de l'offset et extraction des éléments pour la page courante
        $offset = ($page - 1) * $limit;
        $paginatedReservations = array_slice($allReservations, $offset, $limit);
        
        // Calcul du nombre total de pages
        $maxPages = ceil($total / $limit);
    
        return $this->render('reservation_parking/index.html.twig', [
            'reservation_parkings' => $paginatedReservations,
            'current_page' => $page,
            'max_pages' => $maxPages,
            'total_items' => $total
        ]);
    }

    #[Route('/new', name: 'app_reservation_parking_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reservationParking = new ReservationParking();
        $form = $this->createForm(ReservationParkingType::class, $reservationParking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservationParking);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_parking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_parking/new.html.twig', [
            'reservation_parking' => $reservationParking,
            'form' => $form,
        ]);
    }

    #[Route('/{idReservation}', name: 'app_reservation_parking_show', methods: ['GET'])]
    public function show(ReservationParking $reservationParking): Response
    {
        return $this->render('reservation_parking/show.html.twig', [
            'reservation_parking' => $reservationParking,
        ]);
    }
    

    #[Route('/{idReservation}/edit', name: 'app_reservation_parking_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationParking $reservationParking, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationParkingType::class, $reservationParking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_parking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation_parking/edit.html.twig', [
            'reservation_parking' => $reservationParking,
            'form' => $form,
        ]);
    }

    #[Route('/{idReservation}', name: 'app_reservation_parking_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationParking $reservationParking, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationParking->getIdReservation(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reservationParking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_parking_index', [], Response::HTTP_SEE_OTHER);
    }
    #[Route('/{idReservation}/front', name: 'app_reservation_parking_delete_front', methods: ['POST'])]
    public function deleteFront(Request $request, ReservationParking $reservationParking, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationParking->getIdReservation(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($reservationParking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_parking_book', [], Response::HTTP_SEE_OTHER);
    }
   

}
