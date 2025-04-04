<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\UtilisateurRepository;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\Table(name: 'utilisateur')]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
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

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $nomUtilisateur = null;

    public function getNomUtilisateur(): ?string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): self
    {
        $this->nomUtilisateur = $nomUtilisateur;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $prenomUtilisateur = null;

    public function getPrenomUtilisateur(): ?string
    {
        return $this->prenomUtilisateur;
    }

    public function setPrenomUtilisateur(string $prenomUtilisateur): self
    {
        $this->prenomUtilisateur = $prenomUtilisateur;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $emailUtilisateur = null;

    public function getEmailUtilisateur(): ?string
    {
        return $this->emailUtilisateur;
    }

    public function setEmailUtilisateur(string $emailUtilisateur): self
    {
        $this->emailUtilisateur = $emailUtilisateur;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $motDePasseUtilisateur = null;

    public function getMotDePasseUtilisateur(): ?string
    {
        return $this->motDePasseUtilisateur;
    }

    public function setMotDePasseUtilisateur(string $motDePasseUtilisateur): self
    {
        $this->motDePasseUtilisateur = $motDePasseUtilisateur;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $numeroTelephoneUtilisateur = null;

    public function getNumeroTelephoneUtilisateur(): ?string
    {
        return $this->numeroTelephoneUtilisateur;
    }

    public function setNumeroTelephoneUtilisateur(string $numeroTelephoneUtilisateur): self
    {
        $this->numeroTelephoneUtilisateur = $numeroTelephoneUtilisateur;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $roleUtilisateur = null;

    public function getRoleUtilisateur(): ?string
    {
        return $this->roleUtilisateur;
    }

    public function setRoleUtilisateur(string $roleUtilisateur): self
    {
        $this->roleUtilisateur = $roleUtilisateur;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $questionSecurite = null;

    public function getQuestionSecurite(): ?string
    {
        return $this->questionSecurite;
    }

    public function setQuestionSecurite(string $questionSecurite): self
    {
        $this->questionSecurite = $questionSecurite;
        return $this;
    }

    #[ORM\Column(type: 'string', nullable: false)]
    private ?string $reponseSecurite = null;

    public function getReponseSecurite(): ?string
    {
        return $this->reponseSecurite;
    }

    public function setReponseSecurite(string $reponseSecurite): self
    {
        $this->reponseSecurite = $reponseSecurite;
        return $this;
    }

}
