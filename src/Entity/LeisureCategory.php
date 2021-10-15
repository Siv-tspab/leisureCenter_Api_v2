<?php

namespace App\Entity;

use App\Repository\LeisureCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @ORM\Entity(repositoryClass=LeisureCategoryRepository::class)
 */
class LeisureCategory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Serializer\Groups({"list","detail"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Serializer\Groups({"list","detail"})
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=LeisureCenter::class, mappedBy="leisureCategory")
     */
    private $leisureCenters;

    public function __construct()
    {
        $this->leisureCenters = new ArrayCollection();
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
     * @return Collection|LeisureCenter[]
     */
    public function getLeisureCenters(): Collection
    {
        return $this->leisureCenters;
    }

    public function addLeisureCenter(LeisureCenter $leisureCenter): self
    {
        if (!$this->leisureCenters->contains($leisureCenter)) {
            $this->leisureCenters[] = $leisureCenter;
            $leisureCenter->addLeisureCategory($this);
        }

        return $this;
    }

    public function removeLeisureCenter(LeisureCenter $leisureCenter): self
    {
        if ($this->leisureCenters->removeElement($leisureCenter)) {
            $leisureCenter->removeLeisureCategory($this);
        }

        return $this;
    }
}
