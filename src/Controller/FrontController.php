<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\BusRepository;
use App\Repository\MetroRepository;
use App\Repository\TrainRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FrontController extends AbstractController
{
    /**
     * Page d'accueil du front (Dashboard ou autre)
     */
    #[Route('/front', name: 'app_front')]
    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
        ]);
    }

    /**
     * Affiche la page de réservation métro
     */
    #[Route('/reservation/metro', name: 'reservation_metro')]
    public function reservationMetro(): Response
    {
        return $this->render('front/Resmetro.html.twig');
    }

    /**
     * Traite la réservation de métro (form POST/GET)
     */
    #[Route('/reservation/metro/process', name: 'reservation_metro_process', methods: ['POST', 'GET'])]
    public function processMetroReservation(Request $request, EntityManagerInterface $em, Security $security, MetroRepository $metroRepository): Response
    {
        $data = $request->request->all();
        $metros = $metroRepository->findAll();
        $availableMetros = array_map(fn($m) => $m->getNumeroMetro(), $metros);

        if (empty($data['moyen']) || empty($data['date']) || empty($data['paiement'])) {
            $this->addFlash('error', 'Tous les champs sont obligatoires');
            return $this->redirectToRoute('reservation_metro', [
                'metros' => $metros,
                'available_metros' => $availableMetros
            ]);
        }

        try {
            $metro = $metroRepository->find($data['moyen']);

            if (!$metro) {
                throw new \Exception(sprintf(
                    'Métro non trouvé. Numéros disponibles: %s',
                    implode(', ', $availableMetros)
                ));
            }

            $numeroMetro = $metro->getNumeroMetro();

            if (!in_array($numeroMetro, $availableMetros)) {
                throw new \Exception(sprintf(
                    'Numéro de métro invalide. Valides: %s',
                    implode(', ', $availableMetros)
                ));
            }

            $dateReservation = new \DateTime($data['date']);
            $today = new \DateTime();
            if ($dateReservation < $today) {
                throw new \Exception('La date de réservation doit être dans le futur');
            }

            $reservation = new Reservation();
            $reservation->setMoyen($numeroMetro);
            $reservation->setDateRes($dateReservation);
            $reservation->setMoyenPaiement($data['paiement']);
            $reservation->setConfirmationCode(strtoupper(bin2hex(random_bytes(3))));

            if ($user = $security->getUser()) {
                $reservation->setNomUser($user->getPrenomUtilisateur() . ' ' . $user->getNomUtilisateur());
            }

            $em->persist($reservation);
            $em->flush();

            $this->addFlash('success', sprintf(
                'Réservation confirmée pour le métro %s! Code: %s - Date: %s',
                $numeroMetro,
                $reservation->getConfirmationCode(),
                $dateReservation->format('d/m/Y')
            ));
        } catch (\Exception $e) {
            $this->addFlash('error', 'Erreur: ' . $e->getMessage());
            $this->addFlash('debug', 'Numéros disponibles: ' . implode(', ', $availableMetros));
        }

        return $this->render('front/Resmetro.html.twig', [
            'metros' => $metros,
            'available_metros' => $availableMetros
        ]);
    }

    /**
     * Affiche la page de réservation train
     */
    #[Route('/reservation/train', name: 'reservation_train')]
    public function reservationTrain(): Response
    {
        return $this->render('front/ResTrain.html.twig');
    }

    /**
     * Affiche la page de réservation bus
     */
    #[Route('/reservation/bus', name: 'reservation_bus')]
    public function reservationBus(): Response
    {
        return $this->render('front/ResBus.html.twig');
    }
}
