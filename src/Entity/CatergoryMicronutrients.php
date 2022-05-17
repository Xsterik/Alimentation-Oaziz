<?php

namespace App\Entity;

use App\Repository\CatergoryMicronutrientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CatergoryMicronutrientsRepository::class)]
class CatergoryMicronutrients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Micronutrients::class)]
    private $micronutrients;

    #[ORM\Column(type: 'text')]
    private $description;

    public function __construct()
    {
        $this->micronutrients = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * @return Collection<int, Micronutrients>
     */
    public function getMicronutrients(): Collection
    {
        return $this->micronutrients;
    }

    public function addMicronutrient(Micronutrients $micronutrient): self
    {
        if (!$this->micronutrients->contains($micronutrient)) {
            $this->micronutrients[] = $micronutrient;
            $micronutrient->setCategory($this);
        }

        return $this;
    }

    public function removeMicronutrient(Micronutrients $micronutrient): self
    {
        if ($this->micronutrients->removeElement($micronutrient)) {
            // set the owning side to null (unless already changed)
            if ($micronutrient->getCategory() === $this) {
                $micronutrient->setCategory(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
