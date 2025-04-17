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
    #[Assert\NotBlank(message: 'La gare de départ est obligatoire.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'La gare de départ ne peut dépasser {{ limit }} caractères.'
    )]
    private ?string $gareDepart = null;

    #[ORM\Column(type: 'string', length: 255, name: 'gare_arrivee')]
    #[Assert\NotBlank(message: 'La gare d\'arrivée est obligatoire.')]
    #[Assert\Length(
        max: 255,
        maxMessage: 'La gare d\'arrivée ne peut dépasser {{ limit }} caractères.'
    )]
    private ?string $gareArrivee = null;

    #[ORM\Column(type: 'string', length: 5, name: 'heure_depart')]
    #[Assert\NotBlank(message: 'L\'heure de départ est obligatoire.')]
    #[Assert\Regex(
        pattern: '/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/',
        message: 'Le format de l\'heure de départ doit être HH:MM (ex: 14:30).'
    )]
    private ?string $heureDepart = null;

    #[ORM\Column(type: 'string', length: 5, name: 'heure_arrivee')]
    #[Assert\NotBlank(message: 'L\'heure d\'arrivée est obligatoire.')]
    #[Assert\Regex(
        pattern: '/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/',
        message: 'Le format de l\'heure d\'arrivée doit être HH:MM (ex: 18:45).'
    )]
    #[Assert\GreaterThan(
        propertyPath: "heureDepart",
        message: "L'heure d'arrivée doit être postérieure à l'heure de départ."
    )]
    private ?string $heureArrivee = null;


    #[ORM\ManyToOne(targetEntity: Train::class)]
    #[ORM\JoinColumn(name: "train_id", referencedColumnName: "idTrain")] // ✅ Correct
    private ?Train $train = null;


    // ... Getters & Setters ...

    public function getId(): ?int { return $this->id; }

    public function getGareDepart(): ?string { return $this->gareDepart; }
    public function setGareDepart(string $g): self { 
        $this->gareDepart = $g; 
        return $this; 
    }

    public function getGareArrivee(): ?string { return $this->gareArrivee; }
    public function setGareArrivee(string $g): self { 
        $this->gareArrivee = $g; 
        return $this; 
    }

    public function getHeureDepart(): ?string { return $this->heureDepart; }
    public function setHeureDepart(string $heureDepart): self { 
        $this->heureDepart = $heureDepart; 
        return $this; 
    }

    public function getHeureArrivee(): ?string { return $this->heureArrivee; }
    public function setHeureArrivee(string $heureArrivee): self { 
        $this->heureArrivee = $heureArrivee; 
        return $this; 
    }
    public function getTrain(): ?Train { return $this->train; }
    public function setTrain(?Train $train): self { 
        $this->train = $train; 
        return $this; 
    }

}