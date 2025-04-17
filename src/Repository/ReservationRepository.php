<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    /**
     * Récupère les réservations en fonction d’un terme de recherche et d’un critère de tri
     *
     * @param string|null $search Terme de recherche (nom utilisateur, moyen, moyen de paiement, etc.)
     * @param string $sortBy Champ par lequel trier (idRes, nomUser, dateRes, moyenPaiement, etc.)
     * @param string $order ASC ou DESC
     * @return Reservation[]
     */
    public function findBySearchAndSort(?string $search, string $sortBy = 'idRes', string $order = 'ASC'): array
    {
        $qb = $this->createQueryBuilder('r');

        if (!empty($search)) {
            $qb->andWhere('r.nomUser LIKE :search 
                        OR r.moyen LIKE :search 
                        OR r.moyenPaiement LIKE :search 
                        OR r.confirmationCode LIKE :search')
               ->setParameter('search', '%' . $search . '%');
        }

        // Liste blanche des champs autorisés pour éviter les injections SQL
        $allowedSortFields = ['idRes', 'nomUser', 'moyen', 'dateRes', 'moyenPaiement', 'confirmationCode'];
        if (!in_array($sortBy, $allowedSortFields)) {
            $sortBy = 'idRes';
        }

        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC';

        $qb->orderBy('r.' . $sortBy, $order);

        return $qb->getQuery()->getResult();
    }
}
