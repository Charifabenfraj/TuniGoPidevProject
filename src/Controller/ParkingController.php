<?php

namespace App\Controller;

use App\Entity\Parking;
use App\Form\ParkingType;
use App\Repository\ParkingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/parking')]
final class ParkingController extends AbstractController
{
    #[Route(name: 'app_parking_index', methods: ['GET'])]
    public function index(ParkingRepository $parkingRepository): Response
    {
        return $this->render('parking/index.html.twig', [
            'parkings' => $parkingRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_parking_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $parking = new Parking();
        $form = $this->createForm(ParkingType::class, $parking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($parking);
            $entityManager->flush();

            return $this->redirectToRoute('app_parking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parking/new.html.twig', [
            'parking' => $parking,
            'form' => $form,
        ]);
    }

    #[Route('/{idParking}', name: 'app_parking_show', methods: ['GET'])]
    public function show(Parking $parking): Response
    {
        return $this->render('parking/show.html.twig', [
            'parking' => $parking,
        ]);
    }

    #[Route('/{idParking}/edit', name: 'app_parking_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Parking $parking, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParkingType::class, $parking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parking/edit.html.twig', [
            'parking' => $parking,
            'form' => $form,
        ]);
    }

    #[Route('/{idParking}', name: 'app_parking_delete', methods: ['POST'])]
    public function delete(Request $request, Parking $parking, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parking->getIdParking(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($parking);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parking_index', [], Response::HTTP_SEE_OTHER);
    }
}
