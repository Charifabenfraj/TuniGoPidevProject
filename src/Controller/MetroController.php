<?php
// src/Controller/MetroController.php

namespace App\Controller;

use App\Entity\Metro;
use App\Form\MetroType;
use App\Repository\MetroRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/metro', name: 'app_metro_')]
final class MetroController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(MetroRepository $metroRepository): Response
    {
        return $this->render('metro/index.html.twig', [
            'metros' => $metroRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $metro = new Metro();
        $form  = $this->createForm(MetroType::class, $metro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($metro);
            $entityManager->flush();

            return $this->redirectToRoute('app_metro_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('metro/new.html.twig', [
            'metro' => $metro,
            'form'  => $form->createView(),
        ]);
    }

    #[Route(
        '/{idMetro}',
        name: 'show',
        methods: ['GET'],
        requirements: ['idMetro' => '\d+']     // <-- n’accepte que les nombres
    )]
    public function show(Metro $metro): Response
    {
        return $this->render('metro/show.html.twig', [
            'metro' => $metro,
        ]);
    }

    #[Route(
        '/{idMetro}/edit',
        name: 'edit',
        methods: ['GET', 'POST'],
        requirements: ['idMetro' => '\d+']
    )]
    public function edit(
        Request $request,
        MetroRepository $metroRepository,
        EntityManagerInterface $entityManager,
        int $idMetro
    ): JsonResponse {
        $metro = $metroRepository->find($idMetro);
        if (!$metro) {
            return new JsonResponse(['success' => false, 'message' => 'Metro not found'], 404);
        }

        $numeroMetro   = $request->request->get('numeroMetro');
        $idTrajetMetro = $request->request->get('idTrajetMetro');

        $metro->setNumeroMetro($numeroMetro);
        $metro->setIdTrajetMetro($idTrajetMetro);
        $entityManager->flush();

        return new JsonResponse(['success' => true]);
    }

    #[Route(
        '/{idMetro}',
        name: 'delete',
        methods: ['POST'],
        requirements: ['idMetro' => '\d+']
    )]
    public function delete(Request $request, Metro $metro, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$metro->getIdMetro(), $request->request->get('_token'))) {
            $entityManager->remove($metro);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_metro_index', [], Response::HTTP_SEE_OTHER);
    }
}
