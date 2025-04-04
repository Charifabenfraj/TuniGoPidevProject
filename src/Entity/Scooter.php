<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\ScooterRepository;

#[ORM\Entity(repositoryClass: ScooterRepository::class)]
#[ORM\Table(name: 'scooter')]
class Scooter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idScooter = null;

    public function getIdScooter(): ?int
    {
        return $this->idScooter;
    }

    public function setIdScooter(int $idScooter): self
    {
        $this->idScooter = $idScooter;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $numeroScooter = null;

    public function getNumeroScooter(): ?string
    {
        return $this->numeroScooter;
    }

    public function setNumeroScooter(string $numeroScooter): self
    {
        $this->numeroScooter = $numeroScooter;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $localisationScooter = null;

    public function getLocalisationScooter(): ?string
    {
        return $this->localisationScooter;
    }

    public function setLocalisationScooter(string $localisationScooter): self
    {
        $this->localisationScooter = $localisationScooter;
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

    #[ORM\Column(type: 'datetime', nullable: false)]
    private ?\DateTimeInterface $tempsReservation = null;

    public function getTempsReservation(): ?\DateTimeInterface
    {
        return $this->tempsReservation;
    }

    public function setTempsReservation(\DateTimeInterface $tempsReservation): self
    {
        $this->tempsReservation = $tempsReservation;
        return $this;
    }

    #[ORM\Column(type: 'datetime', nullable: false)]
    private ?\DateTimeInterface $tempsArrivee = null;

    public function getTempsArrivee(): ?\DateTimeInterface
    {
        return $this->tempsArrivee;
    }

    public function setTempsArrivee(\DateTimeInterface $tempsArrivee): self
    {
        $this->tempsArrivee = $tempsArrivee;
        return $this;
    }

    public function isdisponible(): ?bool
    {
        return $this->Isdisponible;
    }

}
