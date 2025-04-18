<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\MetroRepository;

#[ORM\Entity(repositoryClass: MetroRepository::class)]
#[ORM\Table(name: 'metro')]
class Metro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'idMetro')]
    private ?int $idMetro = null;

    #[ORM\Column(type: 'string', name: 'numerometro', nullable: false)]
    private ?string $numeroMetro = null;

    #[ORM\Column(type: 'integer', name: 'idTrajetMetro', nullable: true)]
    private ?int $idTrajetMetro = null;

    public function getIdMetro(): ?int
    {
        return $this->idMetro;
    }

    public function setIdMetro(int $idMetro): self
    {
        $this->idMetro = $idMetro;
        return $this;
    }

    public function getNumeroMetro(): ?string
    {
        return $this->numeroMetro;
    }

    public function setNumeroMetro(string $numeroMetro): self
    {
        $this->numeroMetro = $numeroMetro;
        return $this;
    }

    public function getIdTrajetMetro(): ?int
    {
        return $this->idTrajetMetro;
    }

    public function setIdTrajetMetro(?int $idTrajetMetro): self
    {
        $this->idTrajetMetro = $idTrajetMetro;
        return $this;
    }

    public function __toString(): string
    {
        return $this->numeroMetro ?? 'Metro';
    }
}

