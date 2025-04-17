<?php

namespace App\Entity;

use App\Repository\BusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusRepository::class)]
#[ORM\Table(name: 'bus')]
class Bus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'idBus')]
    private ?int $idBus = null;

    #[ORM\Column(name: "numeroBus", type: "string", length: 255, unique: true)]
    private ?string $numeroBus = null;

    #[ORM\OneToMany(mappedBy: 'bus', targetEntity: BusTrajet::class, cascade: ['remove'])]
    private Collection $trajets;

    public function __construct()
    {
        $this->trajets = new ArrayCollection();
    }

    public function getIdBus(): ?int
    {
        return $this->idBus;
    }

    public function getNumeroBus(): ?string
    {
        return $this->numeroBus;
    }

    public function setNumeroBus(string $numeroBus): self
    {
        $this->numeroBus = $numeroBus;
        return $this;
    }

    public function getTrajets(): Collection
    {
        return $this->trajets;
    }

    public function addTrajet(BusTrajet $trajet): self
    {
        if (!$this->trajets->contains($trajet)) {
            $this->trajets[] = $trajet;
            $trajet->setBus($this);
        }

        return $this;
    }

    public function removeTrajet(BusTrajet $trajet): self
    {
        if ($this->trajets->removeElement($trajet)) {
            // Set the owning side to null (unless already changed)
            if ($trajet->getBus() === $this) {
                $trajet->setBus(null);
            }
        }

        return $this;
    }
}
