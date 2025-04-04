<?php

namespace App\Controller;

use App\Entity\Scooter;
use App\Form\ScooterType;
use App\Repository\ScooterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        $form = $this->createForm(ScooterType::class, $scooter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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

    #[Route('/{idScooter}/edit', name: 'app_scooter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Scooter $scooter, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ScooterType::class, $scooter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_scooter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('scooter/edit.html.twig', [
            'scooter' => $scooter,
            'form' => $form,
        ]);
    }

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
