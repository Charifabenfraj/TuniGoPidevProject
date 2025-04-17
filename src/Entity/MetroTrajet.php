<?php
// src/Entity/MetroTrajet.php

namespace App\Entity;


use App\Repository\MetroTrajetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ORM\Entity(repositoryClass: MetroTrajetRepository::class)]
#[ORM\Table(name: 'metro_trajet')]
class MetroTrajet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'id', type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(name: 'gareDepart', type: 'string', length: 255)]
    #[Assert\NotBlank(message: "La gare de départ est obligatoire")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Ne doit pas dépasser {{ limit }} caractères"
    )]
    private ?string $gareDepart = null;

    #[ORM\Column(name: 'gareArrivee', type: 'string', length: 255)]
    #[Assert\NotBlank(message: "La gare d'arrivée est obligatoire")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Ne doit pas dépasser {{ limit }} caractères"
    )]
    private ?string $gareArrivee = null;

    #[ORM\Column(name: 'heureDepart', type: 'time')]
    #[Assert\NotNull(message: "L'heure de départ est requise")]
    private ?\DateTimeInterface $heureDepart = null;

    #[ORM\Column(name: 'heureArrivee', type: 'time')]
    #[Assert\NotNull(message: "L'heure d'arrivée est requise")]
    private ?\DateTimeInterface $heureArrivee = null;

    #[Assert\Callback]
    public function validateHeures(ExecutionContextInterface $context): void
    {
        if ($this->heureDepart && $this->heureArrivee) {
            if ($this->heureArrivee <= $this->heureDepart) {
                $context->buildViolation("L'heure d'arrivée doit être postérieure au départ")
                    ->atPath('heureArrivee')
                    ->addViolation();
            }
        }
    }

    // Getters et Setters existants...
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
    public function __toString(): string
    {
        return $this->gareDepart . ' - ' . $this->gareArrivee;
    }
    
}