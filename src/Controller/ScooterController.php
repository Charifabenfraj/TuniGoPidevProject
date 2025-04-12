<?php

namespace App\Controller;

use App\Entity\Scooter;
use App\Form\ScooterType;
use App\Repository\ScooterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/scooter')]
final class ScooterController extends AbstractController
{
    #[Route(name: 'app_scooter_index', methods: ['GET'])]
    public function index(ScooterRepository $scooterRepository): Response
    {
        return $this->render('scooter/index.html.twig', [
            'scooters' => $scooterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_scooter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $scooter = new Scooter();
    
<<<<<<< HEAD
        // Assurez-vous que les dates par défaut sont définies avant de persister
=======
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
        $scooter->setTempsReservation(new \DateTime()); // Date actuelle
        $scooter->setTempsArrivee(new \DateTime()); // Date actuelle
    
        $form = $this->createForm(ScooterType::class, $scooter);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            // Persistez l'entité après avoir défini les valeurs
            $entityManager->persist($scooter);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_scooter_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('scooter/new.html.twig', [
            'scooter' => $scooter,
            'form' => $form,
        ]);
    }
    

    #[Route('/{idScooter}', name: 'app_scooter_show', methods: ['GET'])]
    public function show(Scooter $scooter): Response
    {
        return $this->render('scooter/show.html.twig', [
            'scooter' => $scooter,
        ]);
    }

<<<<<<< HEAD
    #[Route('/{idScooter}/edit', name: 'app_scooter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ScooterRepository $scooterRepository, EntityManagerInterface $entityManager, $idScooter): JsonResponse
    {
=======
    #[Route('/{idScooter}/edit', name: 'app_scooter_edit', methods: ['POST'])]
    public function edit(
        Request $request,
        ScooterRepository $scooterRepository,
        EntityManagerInterface $entityManager,
        int $idScooter
    ): JsonResponse {
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
        $scooter = $scooterRepository->find($idScooter);
    
        if (!$scooter) {
            return new JsonResponse(['success' => false, 'message' => 'Scooter not found'], 404);
        }
    
        $numeroScooter = $request->request->get('numeroScooter');
<<<<<<< HEAD
        $locationScooter = $request->request->get('locationScooter');
        $reservationId = $request->request->get('reservationId');
        $isAvailable = $request->request->get('isAvailable');
        $reservationTime = $request->request->get('reservationTime');
        $arrivalTime = $request->request->get('arrivalTime');
=======
        $localisationScooter = $request->request->get('localisationScooter');
        $idReservation = $request->request->get('idReservation');
        $isDisponible = $request->request->get('isDisponible');
        $tempsReservation = $request->request->get('tempsReservation');
        $tempsArrivee = $request->request->get('tempsArrivee');
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    
        if ($numeroScooter !== null) {
            $scooter->setNumeroScooter($numeroScooter);
        }
    
<<<<<<< HEAD
        if ($locationScooter !== null) {
            $scooter->setLocationScooter($locationScooter);
        }
    
        if ($reservationId !== null) {
            $scooter->setReservationId($reservationId);
        }
    
        if ($reservationTime !== null) {
            try {
                $scooter->setReservationTime(new \DateTime($reservationTime));
=======
        if ($localisationScooter !== null) {
            $scooter->setLocalisationScooter($localisationScooter);
        }
    
        if ($idReservation !== null) {
            $scooter->setIdReservation($idReservation);
        }
    
        if ($isDisponible !== null) {
            // Correction ici :
            $scooter->setIsDisponible(in_array($isDisponible, ['1', 1, true, 'true'], true));
        }
    
        if ($tempsReservation !== null) {
            try {
                $scooter->setTempsReservation(new \DateTime($tempsReservation));
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
            } catch (\Exception $e) {
                return new JsonResponse(['success' => false, 'message' => 'Invalid reservation time'], 400);
            }
        }
    
<<<<<<< HEAD
        if ($isAvailable !== null) {
            $scooter->setIsAvailable($isAvailable === '1'); 
        }
    
        if ($arrivalTime !== null) {
            try {
                $scooter->setArrivalTime(new \DateTime($arrivalTime));
=======
        if ($tempsArrivee !== null) {
            try {
                // Correction ici :
                $scooter->setTempsArrivee(new \DateTime($tempsArrivee));
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
            } catch (\Exception $e) {
                return new JsonResponse(['success' => false, 'message' => 'Invalid arrival time'], 400);
            }
        }
    
<<<<<<< HEAD
=======
        $entityManager->persist($scooter); // Optionnel mais conseillé
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
        $entityManager->flush();
    
        return new JsonResponse(['success' => true, 'message' => 'Scooter updated successfully']);
    }
<<<<<<< HEAD
=======
    
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d

    #[Route('/{idScooter}', name: 'app_scooter_delete', methods: ['POST'])]
    public function delete(Request $request, Scooter $scooter, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$scooter->getIdScooter(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($scooter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_scooter_index', [], Response::HTTP_SEE_OTHER);
    }
}
