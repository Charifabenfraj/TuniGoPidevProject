<?php

namespace App\Controller;

use App\Repository\BusTrajetRepository;
use App\Repository\TrainTrajetRepository;
use App\Repository\MetroTrajetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/trajets', name: 'trajets_')]
class TrajetController extends AbstractController
{
    public function __construct(
        private BusTrajetRepository $busTrajetRepository,
        private TrainTrajetRepository $trainTrajetRepository,
        private MetroTrajetRepository $metroTrajetRepository
    ) {}

    #[Route('', name: 'index', methods: ['GET'])]
public function index(): Response
{
    return $this->render('front/trajets/trajets.html.twig', [
        'bus_trajets' => $this->busTrajetRepository->findAll(),
        'train_trajets' => $this->trainTrajetRepository->findAll(),
        'metro_trajets' => $this->metroTrajetRepository->findAll()
    ]);
}
}