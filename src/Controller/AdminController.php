<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Utilisateur;

class AdminController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        // Check if user is logged in and has admin role
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        // Get user count
        $userCount = $entityManager->getRepository(Utilisateur::class)->count([]);
        
        // Get recent users
        $recentUsers = $entityManager->getRepository(Utilisateur::class)
            ->findBy([], ['idUtilisateur' => 'DESC'], 5);
        
        // Reservation count - you will need to implement this when you have the entity
        $reservationCount = 0;
        
        // Complaint count - you will need to implement this when you have the entity
        $complaintCount = 0;
        
        // Transport count - you will need to implement this when you have the entity
        $transportCount = 0;
        
        return $this->render('admin/dashboard.html.twig', [
            'userCount' => $userCount,
            'recentUsers' => $recentUsers,
            'reservationCount' => $reservationCount,
            'complaintCount' => $complaintCount,
            'transportCount' => $transportCount,
        ]);
    }
} 