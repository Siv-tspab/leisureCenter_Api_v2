<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 * 
 * @ExclusionPolicy("all")
 */
class Category
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
     * @ORM\ManyToMany(targetEntity=Center::class, mappedBy="category")
     */
    private $centers;

    public function __construct()
    {
        $this->centers = new ArrayCollection();
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
     * @return Collection|Center[]
     */
    public function getCenters(): ArrayCollection
    {
        return $this->centers;
    }

    public function addCenter(Center $center): self
    {
        if (!$this->centers->contains($center)) {
            $this->centers[] = $center;
            $center->addCategory($this);
        }

        return $this;
    }

    public function removeCenter(Center $center): self
    {
        if ($this->centers->removeElement($center)) {
            $center->removeCategory($this);
        }

        return $this;
    }
}
