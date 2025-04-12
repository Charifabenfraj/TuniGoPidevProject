<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

<<<<<<< HEAD
use App\Repository\TrajetbuRepository;

#[ORM\Entity(repositoryClass: TrajetbuRepository::class)]
=======
use App\Repository\TrajetbusRepository;

#[ORM\Entity(repositoryClass: TrajetbusRepository::class)]
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
#[ORM\Table(name: 'trajetbus')]
class Trajetbus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
<<<<<<< HEAD
    #[ORM\Column(type: 'integer')]
=======
    #[ORM\Column(type: 'integer',name: 'idTrajetBus')]
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    private ?int $idTrajetBus = null;

    public function getIdTrajetBus(): ?int
    {
        return $this->idTrajetBus;
    }

    public function setIdTrajetBus(int $idTrajetBus): self
    {
        $this->idTrajetBus = $idTrajetBus;
        return $this;
    }

<<<<<<< HEAD
    #[ORM\Column(type: 'string', nullable: false)]
=======
    #[ORM\Column(type: 'string',name: 'departTrajetbus', nullable: false)]
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    private ?string $departTrajetbus = null;

    public function getDepartTrajetbus(): ?string
    {
        return $this->departTrajetbus;
    }

    public function setDepartTrajetbus(string $departTrajetbus): self
    {
        $this->departTrajetbus = $departTrajetbus;
        return $this;
    }

<<<<<<< HEAD
    #[ORM\Column(type: 'string', nullable: false)]
=======
    #[ORM\Column(type: 'string',name: 'arriveTrajetBus', nullable: false)]
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    private ?string $arriveTrajetBus = null;

    public function getArriveTrajetBus(): ?string
    {
        return $this->arriveTrajetBus;
    }

    public function setArriveTrajetBus(string $arriveTrajetBus): self
    {
        $this->arriveTrajetBus = $arriveTrajetBus;
        return $this;
    }

<<<<<<< HEAD
    #[ORM\Column(type: 'string', nullable: false)]
=======
    #[ORM\Column(type: 'string',name: 'heurDepartBus', nullable: false)]
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    private ?string $heurDepartBus = null;

    public function getHeurDepartBus(): ?string
    {
        return $this->heurDepartBus;
    }

    public function setHeurDepartBus(string $heurDepartBus): self
    {
        $this->heurDepartBus = $heurDepartBus;
        return $this;
    }

<<<<<<< HEAD
    #[ORM\Column(type: 'string', nullable: false)]
=======
    #[ORM\Column(type: 'string',name: 'heurArriveBus', nullable: false)]
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    private ?string $heurArriveBus = null;

    public function getHeurArriveBus(): ?string
    {
        return $this->heurArriveBus;
    }

    public function setHeurArriveBus(string $heurArriveBus): self
    {
        $this->heurArriveBus = $heurArriveBus;
        return $this;
    }

<<<<<<< HEAD
    #[ORM\Column(type: 'decimal', nullable: false)]
=======
    #[ORM\Column(type: 'decimal',name: 'prixTicketBus', nullable: false)]
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    private ?float $prixTicketBus = null;

    public function getPrixTicketBus(): ?float
    {
        return $this->prixTicketBus;
    }

    public function setPrixTicketBus(float $prixTicketBus): self
    {
        $this->prixTicketBus = $prixTicketBus;
        return $this;
    }

<<<<<<< HEAD
    #[ORM\Column(type: 'integer', nullable: false)]
=======
    #[ORM\Column(type: 'integer',name: 'idBus', nullable: false)]
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    private ?int $idBus = null;

    public function getIdBus(): ?int
    {
        return $this->idBus;
    }

    public function setIdBus(int $idBus): self
    {
        $this->idBus = $idBus;
        return $this;
    }

<<<<<<< HEAD
    #[ORM\Column(type: 'integer', nullable: false)]
=======
    #[ORM\Column(type: 'integer',name: 'idReservation', nullable: false)]
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    private ?int $idReservation = null;

    public function getIdReservation(): ?int
    {
        return $this->idReservation;
    }

    public function setIdReservation(int $idReservation): self
    {
        $this->idReservation = $idReservation;
        return $this;
    }

}
