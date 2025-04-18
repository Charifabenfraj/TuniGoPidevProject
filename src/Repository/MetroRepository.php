<?php
namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Metro;

class MetroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Metro::class);
    }

    /**
     * Récupère tous les numéros de métro disponibles
     * @return array Liste des numéros de métro
     */
    public function findAllMetroNumbers(): array
    {
        return $this->createQueryBuilder('m')
            ->select('m.numeroMetro')
            ->where('m.numeroMetro IS NOT NULL')
            ->orderBy('m.numeroMetro', 'ASC')
            ->getQuery()
            ->getSingleColumnResult();
    }

    /**
     * Récupère tous les métros avec leurs IDs et numéros
     * @return array Liste des métros formatés [id => numeroMetro]
     */
    public function findAllMetrosForForm(): array
    {
        $results = $this->createQueryBuilder('m')
            ->select('m.idMetro', 'm.numeroMetro')
            ->where('m.numeroMetro IS NOT NULL')
            ->orderBy('m.numeroMetro', 'ASC')
            ->getQuery()
            ->getResult();

        $metros = [];
        foreach ($results as $result) {
            $metros[$result['idMetro']] = $result['numeroMetro'];
        }

        return $metros;
    }
}