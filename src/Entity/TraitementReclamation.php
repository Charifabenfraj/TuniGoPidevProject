<?php

namespace App\Entity;

use App\Repository\TraitementReclamationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TraitementReclamationRepository::class)]
class TraitementReclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    private ?string $statut_traitement = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $date_traitement = null;

    #[ORM\Column(type: 'text')]
    private ?string $traitement_description = null;

    #[ORM\ManyToOne(targetEntity: Reclamation::class)]
    #[ORM\JoinColumn(name: 'reclamation_id', referencedColumnName: 'idReclamation', nullable: false)]
    private ?Reclamation $reclamation = null;

    public function getReclamation(): ?Reclamation
    {
        return $this->reclamation;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setReclamation(?Reclamation $reclamation): self
    {
        $this->reclamation = $reclamation;
        return $this;
    }

    public function getStatutTraitement(): ?string
    {
        return $this->statut_traitement;
    }

    public function setStatutTraitement(string $statut_traitement): self
    {
        $this->statut_traitement = $statut_traitement;
        return $this;
    }

    public function getDateTraitement(): ?\DateTimeInterface
    {
        return $this->date_traitement;
    }

    public function setDateTraitement(\DateTimeInterface $date_traitement): self
    {
        $this->date_traitement = $date_traitement;
        return $this;
    }

    public function getTraitementDescription(): ?string
    {
        return $this->traitement_description;
    }

    public function setTraitementDescription(string $traitement_description): self
    {
        $this->traitement_description = $traitement_description;
        return $this;
    }
}
