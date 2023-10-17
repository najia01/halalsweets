<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Sweets;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: 'App\Entity\Sweets', inversedBy: 'categories')]
    private Collection $sweets;

    public function __construct()
    {
        $this->sweets = new ArrayCollection();
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

    /**
     * @return Collection<int, Sweets>
     */
    public function getSweets(): Collection
    {
        return $this->sweets;
    }

    public function addSweet(Sweets $sweet): static
    {
        if (!$this->sweets->contains($sweet)) {
            $this->sweets->add($sweet);
        }

        return $this;
    }

    public function removeSweet(Sweets $sweet): static
    {
        $this->sweets->removeElement($sweet);

        return $this;
    }
}
