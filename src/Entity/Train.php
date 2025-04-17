<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\TrainRepository;

#[ORM\Entity(repositoryClass: TrainRepository::class)]
#[ORM\Table(name: 'train')]
class Train
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer',name: 'idTrain')]
    private ?int $idTrain = null;

    public function getIdTrain(): ?int
    {
        return $this->idTrain;
    }

    public function setIdTrain(int $idTrain): self
    {
        $this->idTrain = $idTrain;
        return $this;
    }

    #[ORM\Column(type: 'string',name: 'numeroTrain', nullable: false)]
    private ?string $numeroTrain = null;

    public function getNumeroTrain(): ?string
    {
        return $this->numeroTrain;
    }

    public function setNumeroTrain(string $numeroTrain): self
    {
        $this->numeroTrain = $numeroTrain;
        return $this;
    }

    #[ORM\ManyToOne(targetEntity: Train::class)]
    #[ORM\OneToMany(mappedBy: "train", targetEntity: TrainTrajet::class)]
    private Collection $trajets;
    
    public function getIdTrajetTrain(): ?int
    {
        return $this->idTrajetTrain;
    }

    public function setIdTrajetTrain(?int $idTrajetTrain): self
    {
        $this->idTrajetTrain = $idTrajetTrain;
        return $this;
    }

}
