<?php

namespace App\Repository;

use App\Entity\Reclamation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

class ReclamationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reclamation::class);
    }

    /**
     * Filtre avancé avec pagination
     */
    public function findWithFilters(array $filters, int $page = 1, int $limit = 10): array
    {
        $qb = $this->createQueryBuilder('r');
        
        if (!empty($filters['type'])) {
            $qb->andWhere('r.typeReclamation LIKE :type')
               ->setParameter('type', '%'.$filters['type'].'%');
        }
        
        if (!empty($filters['statut'])) {
            $qb->andWhere('r.statutReclamation = :statut')
               ->setParameter('statut', $filters['statut']);
        }
        
        if (!empty($filters['dateFrom'])) {
            $qb->andWhere('r.dateReclamation >= :dateFrom')
               ->setParameter('dateFrom', new \DateTime($filters['dateFrom']));
        }
        
        if (!empty($filters['dateTo'])) {
            $qb->andWhere('r.dateReclamation <= :dateTo')
               ->setParameter('dateTo', new \DateTime($filters['dateTo']));
        }
        
        if (!empty($filters['search'])) {
            $qb->andWhere('r.descriptionReclamation LIKE :search OR r.nom_utilisateur LIKE :search OR r.prenom_utilisateur LIKE :search')
               ->setParameter('search', '%'.$filters['search'].'%');
        }
        
        return $qb->orderBy('r.dateReclamation', 'DESC')
                 ->setFirstResult(($page - 1) * $limit)
                 ->setMaxResults($limit)
                 ->getQuery()
                 ->getResult();
    }



    /**
     * Statistiques par statut
     */

    public function getStatsByType(): array
    {
        return $this->createQueryBuilder('r')
            ->select('r.typeReclamation as type, COUNT(r.idReclamation) as count')
            ->groupBy('r.typeReclamation')
            ->orderBy('count', 'DESC')
            ->getQuery()
            ->getResult();
    }
    /**
     * Évolution mensuelle des réclamations
     */
   /* public function getMonthlyTrends(int $year = null): array
    {
        $year = $year ?? date('Y');
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = "
            SELECT 
                DATE_FORMAT(r.date_reclamation, '%Y-%m') as month, 
                COUNT(r.id_reclamation) as count
            FROM reclamation r
            WHERE YEAR(r.date_reclamation) = :year
            GROUP BY month
            ORDER BY month ASC
        ";
    
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery(['year' => $year]);
    
        return $result->fetchAllAssociative();
    }*/
    /**
     * Temps moyen de traitement par type
     */
    public function getAverageProcessingTime(): array
    {
        $conn = $this->getEntityManager()->getConnection();
    
        $sql = "
            SELECT 
                r.type_reclamation as type, 
                AVG(DATEDIFF(t.date_fin, r.date_reclamation)) as avg_days
            FROM reclamation r
            LEFT JOIN traitement_reclamation t ON r.id_reclamation = t.reclamation_id
            WHERE t.date_fin IS NOT NULL
            GROUP BY r.type_reclamation
        ";
    
        $stmt = $conn->prepare($sql);
        $result = $stmt->executeQuery();
    
        return $result->fetchAllAssociative();
    }

    /**
     * Top 5 des utilisateurs avec le plus de réclamations
     */
    public function getTopUsersWithReclamations(int $limit = 5): array
    {
        return $this->createQueryBuilder('r')
            ->select('CONCAT(r.nom_utilisateur, \' \', r.prenom_utilisateur) as user, COUNT(r.idReclamation) as count')
            ->groupBy('user')
            ->orderBy('count', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }



/**
 * Statistiques journalières (pour les 30 derniers jours)
 */
public function getDailyStats(int $days = 30): array
{
    $date = new \DateTime("-$days days");
    
    return $this->createQueryBuilder('r')
        ->select("DATE_FORMAT(r.dateReclamation, '%Y-%m-%d') as date, COUNT(r.idReclamation) as count")
        ->where('r.dateReclamation >= :date')
        ->setParameter('date', $date)
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->getQuery()
        ->getResult();
}

/**
 * Statistiques mensuelles
 */
public function getMonthlyStats(): array
{
    return $this->createQueryBuilder('r')
        ->select("DATE_FORMAT(r.dateReclamation, '%Y-%m') as month, COUNT(r.idReclamation) as count")
        ->groupBy('month')
        ->orderBy('month', 'ASC')
        ->getQuery()
        ->getResult();
}


public function getReclamationsGroupedByMonth(): array
{
    $conn = $this->getEntityManager()->getConnection();

    $sql = '
        SELECT DATE_FORMAT(dateReclamation, "%Y-%m") AS month, COUNT(*) AS count
        FROM reclamation
        GROUP BY month
        ORDER BY month ASC
    ';

    $stmt = $conn->prepare($sql);
    $resultSet = $stmt->executeQuery();

    return $resultSet->fetchAllAssociative();
}

}