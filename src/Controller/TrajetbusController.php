<?php

namespace App\Controller;

use App\Entity\Trajetbus;
use App\Form\TrajetbusType;
use App\Repository\TrajetbusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/trajetbus')]
final class TrajetbusController extends AbstractController
{
    #[Route(name: 'app_trajetbus_index', methods: ['GET'])]
    public function index(TrajetbusRepository $trajetbusRepository): Response
    {
        return $this->render('trajetbus/index.html.twig', [
            'trajetbuses' => $trajetbusRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_trajetbus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trajetbus = new Trajetbus();
        $form = $this->createForm(TrajetbusType::class, $trajetbus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($trajetbus);
            $entityManager->flush();

            return $this->redirectToRoute('app_trajetbus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trajetbus/new.html.twig', [
            'trajetbus' => $trajetbus,
            'form' => $form,
        ]);
    }

    #[Route('/{idTrajetBus}', name: 'app_trajetbus_show', methods: ['GET'])]
    public function show(Trajetbus $trajetbus): Response
    {
        return $this->render('trajetbus/show.html.twig', [
            'trajetbus' => $trajetbus,
        ]);
    }

    #[Route('/{idTrajetBus}/edit', name: 'app_trajetbus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Trajetbus $trajetbus, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TrajetbusType::class, $trajetbus);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_trajetbus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('trajetbus/edit.html.twig', [
            'trajetbus' => $trajetbus,
            'form' => $form,
        ]);
    }

    #[Route('/{idTrajetBus}', name: 'app_trajetbus_delete', methods: ['POST'])]
    public function delete(Request $request, Trajetbus $trajetbus, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trajetbus->getIdTrajetBus(), $request->request->get('_token'))) {
            $entityManager->remove($trajetbus);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_trajetbus_index', [], Response::HTTP_SEE_OTHER);
    }
}
