<?php

namespace App\Entity;

use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Sweets::class, inversedBy: 'carts')]
    private Collection $items;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    private ?Users $UserId = null;

    #[ORM\Column]
    private ?int $Total = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Sweets>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Sweets $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
        }

        return $this;
    }

    public function removeItem(Sweets $item): static
    {
        $this->items->removeElement($item);

        return $this;
    }

    public function getUserId(): ?Users
    {
        return $this->UserId;
    }

    public function setUserId(?Users $UserId): static
    {
        $this->UserId = $UserId;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->Total;
    }

    public function setTotal(int $Total): static
    {
        $this->Total = $Total;

        return $this;
    }
}
