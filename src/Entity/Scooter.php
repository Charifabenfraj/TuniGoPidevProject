<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
<<<<<<< HEAD

=======
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
use App\Repository\ScooterRepository;

#[ORM\Entity(repositoryClass: ScooterRepository::class)]
#[ORM\Table(name: 'scooter')]
class Scooter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer',name: 'idScooter')]
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

    #[ORM\Column(type: 'string',name: 'numeroScooter', nullable: false)]
<<<<<<< HEAD
    private ?string $numeroScooter = null;

    public function getNumeroScooter(): ?string
=======
    private string $numeroScooter;

    public function getNumeroScooter(): string
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    {
        return $this->numeroScooter;
    }

    public function setNumeroScooter(string $numeroScooter): self
    {
        $this->numeroScooter = $numeroScooter;
        return $this;
    }

    #[ORM\Column(type: 'string',name: 'localisationScooter', nullable: false)]
<<<<<<< HEAD
    private ?string $localisationScooter = null;

    public function getLocalisationScooter(): ?string
=======
    private string $localisationScooter;

    public function getLocalisationScooter(): string
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    {
        return $this->localisationScooter;
    }

    public function setLocalisationScooter(string $localisationScooter): self
    {
        $this->localisationScooter = $localisationScooter;
        return $this;
    }

    #[ORM\Column(type: 'integer',name: 'idReservation', nullable: true)]
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

<<<<<<< HEAD
    #[ORM\Column(type: 'boolean',name: 'Isdisponible', nullable: false)]
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

    #[ORM\Column(type: 'datetime',name: 'tempsReservation', nullable: false)]
    private ?\DateTimeInterface $tempsReservation = null;

    public function getTempsReservation(): ?\DateTimeInterface
=======
  

    // src/Entity/Scooter.php

#[ORM\Column(type: 'boolean',name: 'isDisponible', nullable: false)]
private bool $isDisponible;

public function getIsDisponible(): bool
{
    return $this->isDisponible;
}

public function setIsDisponible(bool $isDisponible): self
{
    $this->isDisponible = $isDisponible;
    return $this;
}


    #[ORM\Column(type: 'datetime',name: 'tempsReservation', nullable: false)]
    private \DateTimeInterface $tempsReservation;

    public function getTempsReservation(): \DateTimeInterface
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    {
        return $this->tempsReservation;
    }

    public function setTempsReservation(\DateTimeInterface $tempsReservation): self
    {
        $this->tempsReservation = $tempsReservation;
        return $this;
    }

    #[ORM\Column(type: 'datetime',name: 'tempsArrivee', nullable: false)]
<<<<<<< HEAD
    private ?\DateTimeInterface $tempsArrivee = null;

    public function getTempsArrivee(): ?\DateTimeInterface
=======
    private \DateTimeInterface $tempsArrivee;

    public function getTempsArrivee(): \DateTimeInterface
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
    {
        return $this->tempsArrivee;
    }

    public function setTempsArrivee(\DateTimeInterface $tempsArrivee): self
    {
        $this->tempsArrivee = $tempsArrivee;
        return $this;
    }

<<<<<<< HEAD
    public function isdisponible(): ?bool
    {
        return $this->Isdisponible;
    }

=======
    // Constructeur pour initialiser les dates et autres propriétés
    public function __construct()
    {
        $this->tempsReservation = new \DateTime(); // Date actuelle
        $this->tempsArrivee = new \DateTime(); // Date actuelle par défaut
        $this->isDisponible = true; // Valeur par défaut (disponible)
        $this->numeroScooter = ''; // Valeur par défaut pour numéroScooter (chaine vide)
        $this->localisationScooter = ''; // Valeur par défaut pour localisationScooter
    }
>>>>>>> 5c3a1b85154cb33b4a186add19a9da1cc3c98b5d
}
