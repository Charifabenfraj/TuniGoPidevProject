<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\TaxiRepository;

#[ORM\Entity(repositoryClass: TaxiRepository::class)]
#[ORM\Table(name: 'taxi')]
class Taxi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idTaxi = null;

    public function getIdTaxi(): ?int
    {
        return $this->idTaxi;
    }

    public function setIdTaxi(int $idTaxi): self
    {
        $this->idTaxi = $idTaxi;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $numeroTaxi = null;

    public function getNumeroTaxi(): ?string
    {
        return $this->numeroTaxi;
    }

    public function setNumeroTaxi(string $numeroTaxi): self
    {
        $this->numeroTaxi = $numeroTaxi;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $numeroChauffeur = null;

    public function getNumeroChauffeur(): ?string
    {
        return $this->numeroChauffeur;
    }

    public function setNumeroChauffeur(string $numeroChauffeur): self
    {
        $this->numeroChauffeur = $numeroChauffeur;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $prenomChauffeur = null;

    public function getPrenomChauffeur(): ?string
    {
        return $this->prenomChauffeur;
    }

    public function setPrenomChauffeur(string $prenomChauffeur): self
    {
        $this->prenomChauffeur = $prenomChauffeur;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nomChauffeur = null;

    public function getNomChauffeur(): ?string
    {
        return $this->nomChauffeur;
    }

    public function setNomChauffeur(string $nomChauffeur): self
    {
        $this->nomChauffeur = $nomChauffeur;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $idReservation = null;

    public function getIdReservation(): ?int
    {
        return $this->idReservation;
    }

    public function setIdReservation(?int $idReservation): self
    {
        $this->idReservation = $idReservation;
        return $this;
    }

    #[ORM\Column(type: 'boolean', nullable: false)]
    private ?bool $Isdisponible = null;

    public function isIsdisponible(): ?bool
    {
        return $this->Isdisponible;
    }

    public function setIsdisponible(bool $Isdisponible): self
    {
        $this->Isdisponible = $Isdisponible;
        return $this;
    }

    public function isdisponible(): ?bool
    {
        return $this->Isdisponible;
    }

}
