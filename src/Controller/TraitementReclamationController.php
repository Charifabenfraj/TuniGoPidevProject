<?php

namespace App\Controller;

use App\Entity\TraitementReclamation;
use App\Form\TraitementReclamationType;
use App\Repository\ReclamationRepository;
use App\Repository\TraitementReclamationRepository;
use App\Entity\Reclamation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

#[Route('/traitementreclamation')]
final class TraitementReclamationController extends AbstractController
{
    #[Route(name: 'app_traitement_reclamation_index', methods: ['GET'])]
    public function index(TraitementReclamationRepository $traitementReclamationRepository): Response
    {
        return $this->render('traitement_reclamation/index.html.twig', [
            'traitement_reclamations' => $traitementReclamationRepository->findAll(),
           // 'traitements' => $traitementReclamationRepository->findAll(), // Changé de 'traitement_reclamations' à 'traitements'

        ]);
    }
    /*
    #[Route('/new', name: 'app_traitement_reclamation_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Retrieve the 'idReclamation' parameter from the URL
        $idReclamation = $request->query->get('idReclamation');
        
        // If no 'idReclamation' is found, you might want to handle that error
        if (!$idReclamation) {
            // Handle the error, for example redirecting or showing a message
            return $this->redirectToRoute('some_error_route');
        }

        // Find the Reclamation entity by its ID
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($idReclamation);

        if (!$reclamation) {
            // Handle the error if the Reclamation is not found
            throw $this->createNotFoundException('Reclamation not found');
        }

        // Create a new TraitementReclamation instance and associate it with the Reclamation
        $traitementReclamation = new TraitementReclamation();
        $traitementReclamation->setReclamation($reclamation);

        // Create a form to handle TraitementReclamation data
        $form = $this->createForm(TraitementReclamationType::class, $traitementReclamation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Persist the new TraitementReclamation
            $entityManager->persist($traitementReclamation);
            $entityManager->flush();

            // Redirect to a different page, or render a success message
            return $this->redirectToRoute('some_success_route');
        }

        // Render the form for new TraitementReclamation
        return $this->render('traitement_reclamation/new.html.twig', [
            'form' => $form->createView(),
            'reclamation' => $reclamation, // Optionally pass the Reclamation to the view
        ]);
    }
    */

    #[Route('/new', name: 'app_traitement_reclamation_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $traitement = new TraitementReclamation();
        $idReclamation = $request->query->get('idReclamation');
    
        if (!$idReclamation) {
            $this->addFlash('error', 'ID de réclamation manquant.');
            return $this->redirectToRoute('app_reclamation_index');
        }
        if (!$traitement->getDateTraitement()) {
            $traitement->setDateTraitement(new \DateTime());
        }
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($idReclamation);
    
        if (!$reclamation) {
            $this->addFlash('error', 'Réclamation introuvable pour l’ID fourni.');
            return $this->redirectToRoute('app_reclamation_index');
        }
    
        $traitement->setReclamation($reclamation);
    
        $form = $this->createForm(TraitementReclamationType::class, $traitement);
        $form->handleRequest($request);
    
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $traitement->setDateTraitement(new \DateTime());
                //$traitement->getReclamation()->setStatutReclamation($traitement->getStatutTraitement());
                $traitement->getReclamation()->setStatutReclamation('Résolue');

                $entityManager->persist($traitement);
                $entityManager->flush();
    
                $this->addFlash('success', 'Traitement enregistré avec succès.');
                return $this->redirectToRoute('app_reclamation_index');
            } else {
                $this->addFlash('error', 'Erreur dans le formulaire. Veuillez corriger les champs.');
            }
        }
    
        return $this->render('traitement_reclamation/new.html.twig', [
            'form' => $form->createView(),
            'reclamation' => $reclamation,
        ]);
    } 

    
    #[Route('/{id}/edit', name: 'app_traitement_reclamation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TraitementReclamation $traitementReclamation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TraitementReclamationType::class, $traitementReclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_traitement_reclamation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traitement_reclamation/edit.html.twig', [
            'traitement_reclamation' => $traitementReclamation,
            'form' => $form,
        ]);
    }
    /*
    #[Route('/{id}', name: 'app_traitement_reclamation_show', methods: ['GET'])]
    public function show(TraitementReclamation $traitementReclamation): Response
    {
        return $this->render('traitement_reclamation/show.html.twig', [
            'traitement' => $traitementReclamation,
        ]);
    }*/
  
    #[Route('/{id}/modal', name: 'app_traitement_reclamation_modal', methods: ['GET'])]
    public function modal(TraitementReclamation $traitement): Response
    {
        return $this->render('traitement_reclamation/_modal_content.html.twig', [
            'traitement' => $traitement
        ]);
    }
    #[Route('/{id}', name: 'app_traitement_reclamation_delete', methods: ['POST'])]
    public function delete(Request $request, TraitementReclamation $traitementReclamation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$traitementReclamation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($traitementReclamation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_traitement_reclamation_index', [], Response::HTTP_SEE_OTHER);
    }
}
