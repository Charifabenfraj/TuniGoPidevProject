<?php
/*
namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ApiResource(
    normalizationContext: ['groups' => ['notif:read']],
    denormalizationContext: ['groups' => ['notif:write']]
)]
class Notification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['notif:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['notif:read', 'notif:write'])]
    private ?string $message = null;

    #[ORM\Column]
    #[Groups(['notif:read', 'notif:write'])]
    private bool $isRead = false;

    #[ORM\Column]
    #[Groups(['notif:read'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[Groups(['notif:read'])]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getMessage(): ?string
    {
        return $this->message;
    }
    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }
    public function isIsRead(): ?bool
    {
        return $this->isRead;
    }
    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;
        return $this;
    }
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }
    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }
}
*/