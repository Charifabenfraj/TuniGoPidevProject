<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Security; // Ajout du namespace pour Security
use Symfony\Component\Routing\Annotation\Route;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Builder\BuilderInterface;





#[Route('/reservation')]
final class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation_index')]
public function index(Request $request, ReservationRepository $reservationRepository): Response
{
    $search = $request->query->get('search', '');
    $sortBy = $request->query->get('sort_by', 'idRes');
    $order = $request->query->get('order', 'ASC');

    $reservations = $reservationRepository->findBySearchAndSort($search, $sortBy, $order);

    return $this->render('reservation/index.html.twig', [
        'reservations' => $reservations,
        'search' => $search,
        'sort_by' => $sortBy,
        'order' => $order,
    ]);
}

    #[Route('/new', name: 'app_reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        // Récupérer l'utilisateur authentifié
        $user = $security->getUser();
        if ($user) {
            $nomComplet = $user->getPrenomUtilisateur() . ' ' . $user->getNomUtilisateur();
            $reservation->setNomUser($nomComplet);
        }
        // Génération automatique du code de confirmation
        $confirmationCode = strtoupper(bin2hex(random_bytes(5)));
        $reservation->setConfirmationCode($confirmationCode);

        // Gestion du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reservation);
            $entityManager->flush();

            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('reservation/new.html.twig', [
            'reservation' => $reservation,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{idRes}', name: 'app_reservation_show', methods: ['GET'])]
    public function show(Reservation $reservation): Response
    {
        // Créer les données du QR code
        $data = "Réservation ID: {$reservation->getIdRes()}\nNom: {$reservation->getNomUser()}\nDate: {$reservation->getDateRes()?->format('Y-m-d')}";

     /*   // Utiliser Builder pour générer le QR code
        $result = BuilderInterface::create()
            ->writer(new PngWriter())
            ->data($data)
            ->encoding(new Encoding('UTF-8'))
            ->size(200)
            ->build();

        // Convertir le QR code en base64
        $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($result->getString());*/

        // Retourner la vue avec la réservation et le QR code
        return $this->render('reservation/show.html.twig', [
            'reservation' => $reservation,
          //  'qrCodeBase64' => $qrCodeBase64,
        ]);
    }

    #[Route('/{idRes}/edit', name: 'app_reservation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            // Ajouter un message flash après la modification de la réservation
            $this->addFlash('success', 'La réservation a été modifiée avec succès !');
    
            return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('reservation/edit.html.twig', [
            'reservation' => $reservation,
            'form' => $form,
        ]);
    }
    
    #[Route('/{idRes}', name: 'app_reservation_delete', methods: ['POST'])]
    public function delete(Request $request, Reservation $reservation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservation->getIdRes(), $request->get('_token'))) {
            $entityManager->remove($reservation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_reservation_index', [], Response::HTTP_SEE_OTHER);
    }

  

}
