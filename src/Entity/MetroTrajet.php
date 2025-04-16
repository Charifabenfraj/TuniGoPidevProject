<?php
// src/Entity/MetroTrajet.php

namespace App\Entity;

use App\Repository\MetroTrajetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MetroTrajetRepository::class)]
#[ORM\Table(name: 'metro_trajet')]
class MetroTrajet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'gareDepart',   type: 'string', length: 255)]
    private ?string $gareDepart = null;

    #[ORM\Column(name: 'gareArrivee',  type: 'string', length: 255)]
    private ?string $gareArrivee = null;

    #[ORM\Column(name: 'heureDepart',  type: 'time')]
    private ?\DateTimeInterface $heureDepart = null;

    #[ORM\Column(name: 'heureArrivee', type: 'time')]
    private ?\DateTimeInterface $heureArrivee = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGareDepart(): ?string
    {
        return $this->gareDepart;
    }

    public function setGareDepart(string $gareDepart): self
    {
        $this->gareDepart = $gareDepart;
        return $this;
    }

    public function getGareArrivee(): ?string
    {
        return $this->gareArrivee;
    }

    public function setGareArrivee(string $gareArrivee): self
    {
        $this->gareArrivee = $gareArrivee;
        return $this;
    }

    public function getHeureDepart(): ?\DateTimeInterface
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(\DateTimeInterface $heureDepart): self
    {
        $this->heureDepart = $heureDepart;
        return $this;
    }

    public function getHeureArrivee(): ?\DateTimeInterface
    {
        return $this->heureArrivee;
    }

    public function setHeureArrivee(\DateTimeInterface $heureArrivee): self
    {
        $this->heureArrivee = $heureArrivee;
        return $this;
    }
}
