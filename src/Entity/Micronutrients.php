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

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\ManyToMany(targetEntity: Aliments::class, inversedBy: 'micronutrients')]
    private $aliments;

    public function __construct()
    {
        $this->aliments = new ArrayCollection();
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
}
