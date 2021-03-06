<?php

namespace App\Entity;

use App\Repository\CollectibleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CollectibleRepository::class)
 */
class Collectible
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
     * @ORM\Column(type="json", nullable=true)
     */
    private $properties = [];

    /**
     * @ORM\ManyToMany(targetEntity=CollectionEntity::class, mappedBy="collectibles")
     */
    private $collectionEntities;

    /**
     * @ORM\ManyToMany(targetEntity=Alarm::class, mappedBy="collectibles")
     */
    private $alarms;

    /**
     * @ORM\Column(type="array")
     */
    private $propertiesArray = [];

    public function __construct()
    {
        $this->collectionEntities = new ArrayCollection();
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

    public function getProperties(): ?array
    {
        return $this->properties;
    }

    public function setProperties(?array $properties): self
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * @return Collection|CollectionEntity[]
     */
    public function getCollectionEntities(): Collection
    {
        return $this->collectionEntities;
    }

    public function addCollectionEntity(CollectionEntity $collectionEntity): self
    {
        if (!$this->collectionEntities->contains($collectionEntity)) {
            $this->collectionEntities[] = $collectionEntity;
            $collectionEntity->addCollectible($this);
        }

        return $this;
    }

    public function removeCollectionEntity(CollectionEntity $collectionEntity): self
    {
        if ($this->collectionEntities->removeElement($collectionEntity)) {
            $collectionEntity->removeCollectible($this);
        }

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
            $alarm->addCollectible($this);
        }

        return $this;
    }

    public function removeAlarm(Alarm $alarm): self
    {
        if ($this->alarms->removeElement($alarm)) {
            $alarm->removeCollectible($this);
        }

        return $this;
    }

    public function getPropertiesArray(): ?array
    {
        return $this->propertiesArray;
    }

    public function setPropertiesArray(array $propertiesArray): self
    {
        $this->propertiesArray = $propertiesArray;

        return $this;
    }
}
