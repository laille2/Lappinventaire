<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $receiverUsername;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $authorUsername;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthorUsername(): ?string
    {
        return $this->authorUsername;
    }

    public function setAuthorUsername(string $authorUsername): self
    {
        $this->authorUsername = $authorUsername;

        return $this;
    }

    public function getReceiverUsername(): ?string
    {
        return $this->receiverUsername;
    }

    public function setReceiverUsername(?string $receiverUsername): self
    {
        $this->receiverUsername = $receiverUsername;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

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
