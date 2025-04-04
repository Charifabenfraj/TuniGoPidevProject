<?php

namespace App\Controller;

use App\Entity\Bus;
use App\Form\BusType;
use App\Repository\BuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/bus')]
final class BusController extends AbstractController
{
    #[Route(name: 'app_bus_index', methods: ['GET'])]
    public function index(BuRepository $buRepository): Response
    {
        return $this->render('bus/index.html.twig', [
            'buses' => $buRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bus_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bu = new Bus();
        $form = $this->createForm(BusType::class, $bu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bu);
            $entityManager->flush();

            return $this->redirectToRoute('app_bus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bus/new.html.twig', [
            'bu' => $bu,
            'form' => $form,
        ]);
    }

    #[Route('/{idBus}', name: 'app_bus_show', methods: ['GET'])]
    public function show(Bus $bu): Response
    {
        return $this->render('bus/show.html.twig', [
            'bu' => $bu,
        ]);
    }

    #[Route('/{idBus}/edit', name: 'app_bus_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bus $bu, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BusType::class, $bu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bus_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bus/edit.html.twig', [
            'bu' => $bu,
            'form' => $form,
        ]);
    }

    #[Route('/{idBus}', name: 'app_bus_delete', methods: ['POST'])]
    public function delete(Request $request, Bus $bu, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bu->getIdBus(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($bu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bus_index', [], Response::HTTP_SEE_OTHER);
    }
}
