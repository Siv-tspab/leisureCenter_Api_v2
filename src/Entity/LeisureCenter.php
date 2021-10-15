<?php

namespace App\Entity;

use App\Repository\LeisureCenterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=LeisureCenterRepository::class)
 */
class LeisureCenter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Serializer\Groups({"list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Groups({"list","detail"})
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * 
     * @Serializer\Groups({"list","detail"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Groups({"list","detail"})
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Serializer\Groups({"list","detail"})
     */
    private $url;

    /**
     * @ORM\Column(type="array")
     * 
     * @Serializer\Groups({"list","detail"})
     */
    private $coordinates = [];

    /**
     * @Serializer\Groups({"list","detail"})
     */
    private $weather = [];

    /**
     * @ORM\ManyToMany(targetEntity=LeisureCategory::class, inversedBy="leisureCenters")
     * 
     * @Serializer\Groups({"list","detail"})
     */
    private $leisureCategory;

    public function __construct()
    {
        $this->leisureCategory = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCoordinates(): ?array
    {
        return $this->coordinates;
    }

    public function setCoordinates(array $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function getWeather(): ?array
    {
        return $this->weather;
    }

    public function setWeather(?array $weather): self
    {
        $this->weather = $weather;

        return $this;
    }

    /**
     * @return Collection|LeisureCategory[]
     */
    public function getLeisureCategory(): Collection
    {
        return $this->leisureCategory;
    }

    public function addLeisureCategory(LeisureCategory $leisureCategory): self
    {
        if (!$this->leisureCategory->contains($leisureCategory)) {
            $this->leisureCategory[] = $leisureCategory;
        }

        return $this;
    }

    public function removeLeisureCategory(LeisureCategory $leisureCategory): self
    {
        $this->leisureCategory->removeElement($leisureCategory);

        return $this;
    }
}
