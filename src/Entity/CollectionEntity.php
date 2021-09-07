<?php

namespace App\Entity;

use App\Repository\CollectionEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollectionEntityRepository::class)
 */
class CollectionEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Collectible::class, inversedBy="collectionEntities")
     */
    private $collectibles;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="collectionEntitys")
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity=Alarm::class, mappedBy="collectionEntitys")
     */
    private $alarms;

    public function __construct()
    {
        $this->collectibles = new ArrayCollection();
        $this->alarms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Collectible[]
     */
    public function getCollectibles(): Collection
    {
        return $this->collectibles;
    }

    public function addCollectible(Collectible $collectible): self
    {
        if (!$this->collectibles->contains($collectible)) {
            $this->collectibles[] = $collectible;
        }

        return $this;
    }

    public function removeCollectible(Collectible $collectible): self
    {
        $this->collectibles->removeElement($collectible);

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Alarm[]
     */
    public function getAlarms(): Collection
    {
        return $this->alarms;
    }

    public function addAlarm(Alarm $alarm): self
    {
        if (!$this->alarms->contains($alarm)) {
            $this->alarms[] = $alarm;
            $alarm->addCollectionEntity($this);
        }

        return $this;
    }

    public function removeAlarm(Alarm $alarm): self
    {
        if ($this->alarms->removeElement($alarm)) {
            $alarm->removeCollectionEntity($this);
        }

        return $this;
    }
}
