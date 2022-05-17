<?php

namespace App\Entity;

use App\Repository\MicronutrientsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MicronutrientsRepository::class)]
class Micronutrients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToMany(targetEntity: Aliments::class, inversedBy: 'micronutrients')]
    private $aliments;

    #[ORM\ManyToOne(targetEntity: CatergoryMicronutrients::class, inversedBy: 'micronutrients')]
    private $category;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'text')]
    private $bienfaits;

    public function __construct()
    {
        $this->aliments = new ArrayCollection();
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
     * @return Collection<int, Aliments>
     */
    public function getAliments(): Collection
    {
        return $this->aliments;
    }

    public function addAliment(Aliments $aliment): self
    {
        if (!$this->aliments->contains($aliment)) {
            $this->aliments[] = $aliment;
        }

        return $this;
    }

    public function removeAliment(Aliments $aliment): self
    {
        $this->aliments->removeElement($aliment);

        return $this;
    }

    public function getCategory(): ?CatergoryMicronutrients
    {
        return $this->category;
    }

    public function setCategory(?CatergoryMicronutrients $category): self
    {
        $this->category = $category;

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

    public function getBienfaits(): ?string
    {
        return $this->bienfaits;
    }

    public function setBienfaits(string $bienfaits): self
    {
        $this->bienfaits = $bienfaits;

        return $this;
    }
}
