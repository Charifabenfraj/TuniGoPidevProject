<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\ReclamationRepository;

#[ORM\Entity(repositoryClass: ReclamationRepository::class)]
#[ORM\Table(name: 'reclamation')]
class Reclamation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $idReclamation = null;

    public function getIdReclamation(): ?int
    {
        return $this->idReclamation;
    }

    public function setIdReclamation(int $idReclamation): self
    {
        $this->idReclamation = $idReclamation;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $typeReclamation = null;

    public function getTypeReclamation(): ?string
    {
        return $this->typeReclamation;
    }

    public function setTypeReclamation(string $typeReclamation): self
    {
        $this->typeReclamation = $typeReclamation;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $descriptionReclamation = null;

    public function getDescriptionReclamation(): ?string
    {
        return $this->descriptionReclamation;
    }

    public function setDescriptionReclamation(string $descriptionReclamation): self
    {
        $this->descriptionReclamation = $descriptionReclamation;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $statutReclamation = null;

    public function getStatutReclamation(): ?string
    {
        return $this->statutReclamation;
    }

    public function setStatutReclamation(string $statutReclamation): self
    {
        $this->statutReclamation = $statutReclamation;
        return $this;
    }

    #[ORM\Column(type: 'date', nullable: false)]
    private ?\DateTimeInterface $dateReclamation = null;

    public function getDateReclamation(): ?\DateTimeInterface
    {
        return $this->dateReclamation;
    }

    public function setDateReclamation(\DateTimeInterface $dateReclamation): self
    {
        $this->dateReclamation = $dateReclamation;
        return $this;
    }

    #[ORM\ManyToOne(targetEntity: Utilisateur1::class, inversedBy: 'reclamations')]
    #[ORM\JoinColumn(name: 'idUtilisateur', referencedColumnName: 'idUtilisateur')]
    private ?Utilisateur1 $utilisateur1 = null;

    public function getUtilisateur1(): ?Utilisateur1
    {
        return $this->utilisateur1;
    }

    public function setUtilisateur1(?Utilisateur1 $utilisateur1): self
    {
        $this->utilisateur1 = $utilisateur1;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nom_utilisateur = null;

    public function getNom_utilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNom_utilisateur(string $nom_utilisateur): self
    {
        $this->nom_utilisateur = $nom_utilisateur;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $prenom_utilisateur = null;

    public function getPrenom_utilisateur(): ?string
    {
        return $this->prenom_utilisateur;
    }

    public function setPrenom_utilisateur(string $prenom_utilisateur): self
    {
        $this->prenom_utilisateur = $prenom_utilisateur;
        return $this;
    }

    public function getNomUtilisateur(): ?string
    {
        return $this->nom_utilisateur;
    }

    public function setNomUtilisateur(string $nom_utilisateur): static
    {
        $this->nom_utilisateur = $nom_utilisateur;

        return $this;
    }

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenom_utilisateur;
    }

    public function setPrenomUtilisateur(string $prenom_utilisateur): static
    {
        $this->prenom_utilisateur = $prenom_utilisateur;

        return $this;
    }

}
