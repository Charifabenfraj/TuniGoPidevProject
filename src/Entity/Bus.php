<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\BuRepository;

#[ORM\Entity(repositoryClass: BuRepository::class)]
#[ORM\Table(name: 'bus')]
class Bus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer',name: 'id_Bus')]
    private ?int $idBus = null;

    public function getIdBus(): ?int
    {
        return $this->idBus;
    }

    public function setIdBus(int $idBus): self
    {
        $this->idBus = $idBus;
        return $this;
    }

    #[ORM\Column(type: 'string',name: 'numero_Bus', nullable: false)]
    private ?string $numeroBus = null;

    public function getNumeroBus(): ?string
    {
        return $this->numeroBus;
    }

    public function setNumeroBus(string $numeroBus): self
    {
        $this->numeroBus = $numeroBus;
        return $this;
    }

    #[ORM\Column(type: 'integer',name: 'id_Trajet_Bus', nullable: true)]
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

}
