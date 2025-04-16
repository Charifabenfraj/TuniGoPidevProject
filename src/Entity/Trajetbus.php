<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\TrajetbusRepository;

#[ORM\Entity(repositoryClass: TrajetbusRepository::class)]
#[ORM\Table(name: 'trajetbus')]
class Trajetbus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'idTrajetBus')] // Correspond à la colonne idTrajetBus
    private ?int $idTrajetBus = null;

    #[ORM\Column(type: 'string', name: 'departTrajetBus', nullable: false)] // Correspond à la colonne departTrajetBus
    private ?string $departTrajetbus = null;

    #[ORM\Column(type: 'string', name: 'arriveTrajetBus', nullable: false)] // Correspond à la colonne arriveTrajetBus
    private ?string $arriveTrajetBus = null;

    #[ORM\Column(type: 'string', name: 'heurDepartBus', nullable: false)] // Correspond à la colonne heurDepartBus
    private ?string $heurDepartBus = null;

    #[ORM\Column(type: 'string', name: 'heurArriveBus', nullable: false)] // Correspond à la colonne heurArriveBus
    private ?string $heurArriveBus = null;

    #[ORM\Column(type: 'decimal', name: 'prixTicketBus', precision: 10, scale: 2, nullable: false)] // Correspond à la colonne prixTicketBus
    private ?float $prixTicketBus = null;

    #[ORM\Column(type: 'integer', name: 'idBus', nullable: false)] // Correspond à la colonne idBus
    private ?int $idBus = null;

    #[ORM\Column(type: 'integer', name: 'idReservation', nullable: false)] // Correspond à la colonne idReservation
    private ?int $idReservation = null;

    // Getters et setters

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
