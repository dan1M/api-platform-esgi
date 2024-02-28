<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\MetaData\Get;
use ApiPlatform\MetaData\Post;
use ApiPlatform\MetaData\Put;
use ApiPlatform\MetaData\Delete;


#[ORM\Entity(repositoryClass: RecipeRepository::class)]
#[ApiResource(operations: [new Get(), new Post(), new Put(), new Delete()])]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $preparation = null;

    #[ORM\Column(nullable: true)]
    private ?int $preparation_time = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $difficulty = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_url = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_private = null;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'recipes')]
    private Collection $ingredients;

    #[ORM\ManyToOne(inversedBy: 'recipes')]
    private ?RecipeCategory $category = null;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPreparation(): ?string
    {
        return $this->preparation;
    }

    public function setPreparation(?string $preparation): static
    {
        $this->preparation = $preparation;

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparation_time;
    }

    public function setPreparationTime(?int $preparation_time): static
    {
        $this->preparation_time = $preparation_time;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(?string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(?string $image_url): static
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function isIsPrivate(): ?bool
    {
        return $this->is_private;
    }

    public function setIsPrivate(?bool $is_private): static
    {
        $this->is_private = $is_private;

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }

    public function getCategory(): ?RecipeCategory
    {
        return $this->category;
    }

    public function setCategory(?RecipeCategory $category): static
    {
        $this->category = $category;

        return $this;
    }
}
