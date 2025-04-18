<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TrajetbusRepository;

#[ORM\Entity(repositoryClass: TrajetbusRepository::class)]
#[ORM\Table(name: 'trajetbus')]
class Trajetbus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'idTrajetBus')]
    private ?int $idTrajetBus = null;

    #[ORM\Column(type: 'string', name: 'departTrajetbus', nullable: false)]
    private ?string $departTrajetbus = null;

    #[ORM\Column(type: 'string', name: 'arriveTrajetBus', nullable: false)]
    private ?string $arriveTrajetBus = null;

    #[ORM\Column(type: 'string', name: 'heurDepartBus', nullable: false)]
    private ?string $heurDepartBus = null;

    #[ORM\Column(type: 'string', name: 'heurArriveBus', nullable: false)]
    private ?string $heurArriveBus = null;

    #[ORM\Column(type: 'decimal', name: 'prixTicketBus', nullable: false)]
    private ?float $prixTicketBus = null;

    #[ORM\Column(type: 'integer', name: 'idBus', nullable: false)]
    private ?int $idBus = null;

    #[ORM\Column(type: 'integer', name: 'idReservation', nullable: false)]
    private ?int $idReservation = null;

    public function getIdTrajetBus(): ?int
    {
        return $this->idTrajetBus;
    }

    public function setIdTrajetBus(int $idTrajetBus): self
    {
        $this->idTrajetBus = $idTrajetBus;
        return $this;
    }

    public function getDepartTrajetbus(): ?string
    {
        return $this->departTrajetbus;
    }

    public function setDepartTrajetbus(string $departTrajetbus): self
    {
        $this->departTrajetbus = $departTrajetbus;
        return $this;
    }

    public function getArriveTrajetBus(): ?string
    {
        return $this->arriveTrajetBus;
    }

    public function setArriveTrajetBus(string $arriveTrajetBus): self
    {
        $this->arriveTrajetBus = $arriveTrajetBus;
        return $this;
    }

    public function getHeurDepartBus(): ?string
    {
        return $this->heurDepartBus;
    }

    public function setHeurDepartBus(string $heurDepartBus): self
    {
        $this->heurDepartBus = $heurDepartBus;
        return $this;
    }

    public function getHeurArriveBus(): ?string
    {
        return $this->heurArriveBus;
    }

    public function setHeurArriveBus(string $heurArriveBus): self
    {
        $this->heurArriveBus = $heurArriveBus;
        return $this;
    }

    public function getPrixTicketBus(): ?float
    {
        return $this->prixTicketBus;
    }

    public function setPrixTicketBus(float $prixTicketBus): self
    {
        $this->prixTicketBus = $prixTicketBus;
        return $this;
    }

    public function getIdBus(): ?int
    {
        return $this->idBus;
    }

    public function setIdBus(int $idBus): self
    {
        $this->idBus = $idBus;
        return $this;
    }

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
