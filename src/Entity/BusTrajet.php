<?php

namespace App\Entity;

use App\Repository\BusTrajetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BusTrajetRepository::class)]
#[ORM\Table(name: 'bus_trajet')]
class BusTrajet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'id')]
    private ?int $id = null;

    
    #[ORM\Column(type: 'string', name: 'stationDepart')]
    #[Assert\NotBlank(message: 'La station de départ est obligatoire.')]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Minimum {{ limit }} caractères',
        maxMessage: 'Maximum {{ limit }} caractères'
    )]
    #[Assert\Regex(
        pattern: '/^[\p{L}\s\-\']+$/u',
        message: 'Caractères spéciaux interdits'
    )]
    private ?string $stationDepart = null;

    #[ORM\Column(type: 'string', name: 'stationArrivee')]
    #[Assert\NotBlank(message: 'La station d\'arrivée est obligatoire.')]
    #[Assert\Length(
        min: 2,
        max: 255,
        minMessage: 'Minimum {{ limit }} caractères',
        maxMessage: 'Maximum {{ limit }} caractères'
    )]
    #[Assert\Regex(
        pattern: '/^[\p{L}\s\-\']+$/u',
        message: 'Caractères spéciaux interdits'
    )]
    private ?string $stationArrivee = null;

    #[ORM\Column(type: 'string', name: 'heureDepart')]
    #[Assert\NotBlank(message: 'Heure de départ requise')]
    #[Assert\Regex(
        pattern: '/^(2[0-3]|[01][0-9]):[0-5][0-9]$/',
        message: 'Format HH:MM requis (ex: 14:30)'
    )]
    private ?string $heureDepart = null;

    #[ORM\Column(type: 'string', name: 'heureArrivee')]
    #[Assert\NotBlank(message: 'Heure d\'arrivée requise')]
    #[Assert\Regex(
        pattern: '/^(2[0-3]|[01][0-9]):[0-5][0-9]$/',
        message: 'Format HH:MM requis (ex: 16:45)'
    )]
    private ?string $heureArrivee = null;

    #[ORM\ManyToOne(targetEntity: Bus::class)]
    #[ORM\JoinColumn(name: "idBus", referencedColumnName: "idBus")]
    #[Assert\NotNull(message: 'Sélectionnez un bus')]
    private ?Bus $bus = null;

    // Getters/Setters...

    public static function validateHeureArrivee($object, ExecutionContextInterface $context): void
    {
        if ($object->getHeureDepart() && $object->getHeureArrivee()) {
            $depart = \DateTimeImmutable::createFromFormat('H:i', $object->getHeureDepart());
            $arrivee = \DateTimeImmutable::createFromFormat('H:i', $object->getHeureArrivee());

            if ($arrivee <= $depart) {
                $context->buildViolation('L\'heure d\'arrivée doit être postérieure au départ')
                    ->atPath('heureArrivee')
                    ->addViolation();
            }
        }
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStationDepart(): ?string
    {
        return $this->stationDepart;
    }

    public function setStationDepart(string $stationDepart): self
    {
        $this->stationDepart = $stationDepart;
        return $this;
    }

    public function getStationArrivee(): ?string
    {
        return $this->stationArrivee;
    }

    public function setStationArrivee(string $stationArrivee): self
    {
        $this->stationArrivee = $stationArrivee;
        return $this;
    }

    public function getHeureDepart(): ?string
    {
        return $this->heureDepart;
    }

    public function setHeureDepart(string $heureDepart): self
    {
        $this->heureDepart = $heureDepart;
        return $this;
    }

    public function getHeureArrivee(): ?string
    {
        return $this->heureArrivee;
    }

    public function setHeureArrivee(string $heureArrivee): self
    {
        $this->heureArrivee = $heureArrivee;
        return $this;
    }

    public function getBus(): ?Bus
    {
        return $this->bus;
    }

    public function setBus(?Bus $bus): self
    {
        $this->bus = $bus;
        return $this;
    }
}
