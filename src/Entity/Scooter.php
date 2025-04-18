<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ScooterRepository;

#[ORM\Entity(repositoryClass: ScooterRepository::class)]
#[ORM\Table(name: 'scooter')]
class Scooter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'idScooter')]
    private ?int $idScooter = null;

    #[ORM\Column(type: 'string', name: 'numeroScooter', nullable: false)]
    private string $numeroScooter = '';

    #[ORM\Column(type: 'string', name: 'localisationScooter', nullable: false)]
    private string $localisationScooter = '';

    #[ORM\Column(type: 'integer', name: 'idReservation', nullable: true)]
    private ?int $idReservation = null;

    #[ORM\Column(type: 'boolean', name: 'isDisponible', nullable: false)]
    private bool $isDisponible = true;

    #[ORM\Column(type: 'datetime', name: 'tempsReservation', nullable: false)]
    private \DateTimeInterface $tempsReservation;

    #[ORM\Column(type: 'datetime', name: 'tempsArrivee', nullable: false)]
    private \DateTimeInterface $tempsArrivee;

    public function __construct()
    {
        $this->tempsReservation = new \DateTime();
        $this->tempsArrivee = new \DateTime();
        $this->isDisponible = true;
    }

    public function getIdScooter(): ?int
    {
        return $this->idScooter;
    }

    public function setIdScooter(int $idScooter): self
    {
        $this->idScooter = $idScooter;
        return $this;
    }

    public function getNumeroScooter(): string
    {
        return $this->numeroScooter;
    }

    public function setNumeroScooter(string $numeroScooter): self
    {
        $this->numeroScooter = $numeroScooter;
        return $this;
    }

    public function getLocalisationScooter(): string
    {
        return $this->localisationScooter;
    }

    public function setLocalisationScooter(string $localisationScooter): self
    {
        $this->localisationScooter = $localisationScooter;
        return $this;
    }

    public function getIdReservation(): ?int
    {
        return $this->idReservation;
    }

    public function setIdReservation(?int $idReservation): self
    {
        $this->idReservation = $idReservation;
        return $this;
    }

    public function isDisponible(): bool
    {
        return $this->isDisponible;
    }

    public function setIsDisponible(bool $isDisponible): self
    {
        $this->isDisponible = $isDisponible;
        return $this;
    }

    public function getTempsReservation(): \DateTimeInterface
    {
        return $this->tempsReservation;
    }

    public function setTempsReservation(\DateTimeInterface $tempsReservation): self
    {
        $this->tempsReservation = $tempsReservation;
        return $this;
    }

    public function getTempsArrivee(): \DateTimeInterface
    {
        return $this->tempsArrivee;
    }

    public function setTempsArrivee(\DateTimeInterface $tempsArrivee): self
    {
        $this->tempsArrivee = $tempsArrivee;
        return $this;
    }
}
