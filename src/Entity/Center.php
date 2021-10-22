<?php

namespace App\Entity;

use App\Repository\CenterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;


/**
 * @ORM\Entity(repositoryClass=CenterRepository::class)
 * 
 * @ExclusionPolicy("all")
 */
class Center
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Expose
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * 
     * @Expose
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Expose
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Expose
     */
    private $url;

    /**
     * @ORM\Column(type="array")
     * 
     * @Expose
     */
    private $coordinates = [];

    /**
     * @Expose
     */
    private $weather = [];

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="centers")
     * 
     * @Expose
     */
    private $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
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

    public function setWeather(array $weather): self
    {
        $this->weather = $weather;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category[] = $category;
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }
}
