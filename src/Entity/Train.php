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
    #[ORM\Column(type: 'integer')]
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

    #[ORM\Column(type: 'string', nullable: false)]
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

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $idTrajetTrain = null;

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
