<?php
// src/Entity/TrainTrajet.php

namespace App\Entity;

use App\Repository\TrainTrajetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TrainTrajetRepository::class)]
#[ORM\Table(name: 'train_trajet')]
class TrainTrajet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'id')]
    private ?int $id = null;
    

    #[ORM\Column(type: 'string', length: 255, name: 'gare_depart')]
    private ?string $gareDepart = null;

    #[ORM\Column(type: 'string', length: 255, name: 'gare_arrivee')]
    private ?string $gareArrivee = null;

    #[ORM\Column(type: 'string', length: 5, name: 'heure_depart')]
    #[Assert\Regex(
        pattern: '/^(?:[01]\d|2[0-3]):[0-5]\d$/',
        message: 'L\'heure de départ doit être au format HH:MM.'
    )]
    private ?string $heureDepart = null;

    #[ORM\Column(type: 'string', length: 5, name: 'heure_arrivee')]
    #[Assert\Regex(
        pattern: '/^(?:[01]\d|2[0-3]):[0-5]\d$/',
        message: 'L\'heure d\'arrivée doit être au format HH:MM.'
    )]
    private ?string $heureArrivee = null;

    #[ORM\Column(type: 'string', length: 50, name: 'numero_train')]
    private ?string $numeroTrain = null;

    // … Getters & Setters en camelCase …

    public function getId(): ?int { return $this->id; }

    public function getGareDepart(): ?string { return $this->gareDepart; }
    public function setGareDepart(string $g): self { $this->gareDepart = $g; return $this; }

    public function getGareArrivee(): ?string { return $this->gareArrivee; }
    public function setGareArrivee(string $g): self { $this->gareArrivee = $g; return $this; }

    public function getHeureDepart(): ?string
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(string $heureDepart): self
    {
        $this->heureDepart = $heureDepart;
        return $this;
    }

    public function getHeureArrivee(): ?string
    {
        return $this->heureArrivee;
    }

    public function setHeureArrivee(string $heureArrivee): self
    {
        $this->heureArrivee = $heureArrivee;
        return $this;
    }

    public function getNumeroTrain(): ?string { return $this->numeroTrain; }
    public function setNumeroTrain(string $n): self { $this->numeroTrain = $n; return $this; }
}
