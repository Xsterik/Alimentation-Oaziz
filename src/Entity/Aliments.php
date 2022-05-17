<?php

namespace App\Entity;

use App\Repository\AlimentsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;


 #[ORM\Entity(repositoryClass: AlimentsRepository::class)]
                                                             
                           class Aliments
                           {
                               #[ORM\Id]
                               #[ORM\GeneratedValue]
                               #[ORM\Column(type: 'integer')]
                               private $id;
                           
                               #[ORM\Column(type: 'string', length: 255)]
                               private $name;
                           
                               #[ORM\Column(type: 'float')]
                               private $protein;
                           
                               #[ORM\Column(type: 'float')]
                               private $carbohydrate;
                           
                               #[ORM\Column(type: 'float')]
                               private $lipid;
                           
                               #[ORM\ManyToOne(targetEntity: CategoryAliments::class, inversedBy: 'aliments')]
                               private $categoryAliments;
                           
                               #[ORM\ManyToMany(targetEntity: Micronutrients::class, mappedBy: 'aliments')]
                               private $micronutrients;
                        
                               #[ORM\Column(type: 'array', nullable: true)]
                               private $seasonsToConsume = [];
               
                               #[ORM\Column(type: 'text')]
                               private $description;
      
                               #[ORM\Column(type: 'string', length: 255)]
                               private $image;
                           
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
                           
                               public function getProtein(): ?float
                               {
                                   return $this->protein;
                               }
                           
                               public function setProtein(float $protein): self
                               {
                                   $this->protein = $protein;
                           
                                   return $this;
                               }
                           
                               public function getCarbohydrate(): ?float
                               {
                                   return $this->carbohydrate;
                               }
                           
                               public function setCarbohydrate(float $carbohydrate): self
                               {
                                   $this->carbohydrate = $carbohydrate;
                           
                                   return $this;
                               }
                           
                               public function getLipid(): ?float
                               {
                                   return $this->lipid;
                               }
                           
                               public function setLipid(float $lipid): self
                               {
                                   $this->lipid = $lipid;
                           
                                   return $this;
                               }
                           
                               public function getCategoryAliments(): ?CategoryAliments
                               {
                                   return $this->categoryAliments;
                               }
                           
                               public function setCategoryAliments(?CategoryAliments $categoryAliments): self
                               {
                                   $this->categoryAliments = $categoryAliments;
                           
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
                                       $micronutrient->addAliment($this);
                                   }
                           
                                   return $this;
                               }
                           
                               public function removeMicronutrient(Micronutrients $micronutrient): self
                               {
                                   if ($this->micronutrients->removeElement($micronutrient)) {
                                       $micronutrient->removeAliment($this);
                                   }
                           
                                   return $this;
                               }
                     
                               public function getSeasonsToConsume(): ?array
                               {
                                   return $this->seasonsToConsume;
                               }
                  
                               public function setSeasonsToConsume(?array $seasonsToConsume): self
                               {
                                   $this->seasonsToConsume = $seasonsToConsume;
                  
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
   
                               public function getImage(): ?string
                               {
                                   return $this->image;
                               }

                               public function setImage(string $image): self
                               {
                                   $this->image = $image;

                                   return $this;
                               }
                           }
