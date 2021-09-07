<?php

namespace App\Entity;

use App\Repository\AlarmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlarmRepository::class)
 */
class Alarm
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
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity=CollectionEntity::class, inversedBy="alarms")
     */
    private $collectionEntitys;

    /**
     * @ORM\ManyToMany(targetEntity=Collectible::class, inversedBy="alarms")
     */
    private $collectibles;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $properties = [];

    public function __construct()
    {
        $this->collectionEntitys = new ArrayCollection();
        $this->collectibles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|CollectionEntity[]
     */
    public function getCollectionEntitys(): Collection
    {
        return $this->collectionEntitys;
    }

    public function addCollectionEntity(CollectionEntity $collectionEntity): self
    {
        if (!$this->collectionEntitys->contains($collectionEntity)) {
            $this->collectionEntitys[] = $collectionEntity;
        }

        return $this;
    }

    public function removeCollectionEntity(CollectionEntity $collectionEntity): self
    {
        $this->collectionEntitys->removeElement($collectionEntity);

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

    public function getProperties(): ?array
    {
        return $this->properties;
    }

    public function setProperties(?array $properties): self
    {
        $this->properties = $properties;

        return $this;
    }
}
