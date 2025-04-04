<?php

namespace App\Controller;

use App\Entity\Taxi;
use App\Form\TaxiType;
use App\Repository\TaxiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/taxi')]
final class TaxiController extends AbstractController
{
    #[Route(name: 'app_taxi_index', methods: ['GET'])]
    public function index(TaxiRepository $taxiRepository): Response
    {
        return $this->render('taxi/index.html.twig', [
            'taxis' => $taxiRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_taxi_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $taxi = new Taxi();
        $form = $this->createForm(TaxiType::class, $taxi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($taxi);
            $entityManager->flush();

            return $this->redirectToRoute('app_taxi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('taxi/new.html.twig', [
            'taxi' => $taxi,
            'form' => $form,
        ]);
    }

    #[Route('/{idTaxi}', name: 'app_taxi_show', methods: ['GET'])]
    public function show(Taxi $taxi): Response
    {
        return $this->render('taxi/show.html.twig', [
            'taxi' => $taxi,
        ]);
    }

    #[Route('/{idTaxi}/edit', name: 'app_taxi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Taxi $taxi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TaxiType::class, $taxi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_taxi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('taxi/edit.html.twig', [
            'taxi' => $taxi,
            'form' => $form,
        ]);
    }

    #[Route('/{idTaxi}', name: 'app_taxi_delete', methods: ['POST'])]
    public function delete(Request $request, Taxi $taxi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$taxi->getIdTaxi(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($taxi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_taxi_index', [], Response::HTTP_SEE_OTHER);
    }
}
