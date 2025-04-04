<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\ReservationParkingRepository;

#[ORM\Entity(repositoryClass: ReservationParkingRepository::class)]
#[ORM\Table(name: 'reservation_parking')]
class ReservationParking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
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

    #[ORM\Column(type: 'datetime', nullable: false)]
    private ?\DateTimeInterface $dateReservation = null;

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: false)]
    private ?int $idUtilisateur = null;

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $idTrajetTrain = null;

    public function getIdTrajetTrain(): ?int
    {
        return $this->idTrajetTrain;
    }

    public function setIdTrajetTrain(?int $idTrajetTrain): self
    {
        $this->idTrajetTrain = $idTrajetTrain;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $idTrajetMetro = null;

    public function getIdTrajetMetro(): ?int
    {
        return $this->idTrajetMetro;
    }

    public function setIdTrajetMetro(?int $idTrajetMetro): self
    {
        $this->idTrajetMetro = $idTrajetMetro;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $idTrajetBus = null;

    public function getIdTrajetBus(): ?int
    {
        return $this->idTrajetBus;
    }

    public function setIdTrajetBus(?int $idTrajetBus): self
    {
        $this->idTrajetBus = $idTrajetBus;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $idScooter = null;

    public function getIdScooter(): ?int
    {
        return $this->idScooter;
    }

    public function setIdScooter(?int $idScooter): self
    {
        $this->idScooter = $idScooter;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $idTaxi = null;

    public function getIdTaxi(): ?int
    {
        return $this->idTaxi;
    }

    public function setIdTaxi(?int $idTaxi): self
    {
        $this->idTaxi = $idTaxi;
        return $this;
    }

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $idParking = null;

    public function getIdParking(): ?int
    {
        return $this->idParking;
    }

    public function setIdParking(?int $idParking): self
    {
        $this->idParking = $idParking;
        return $this;
    }

}
