<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $total_price = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $uid = null;

    #[ORM\OneToMany(mappedBy: 'sweetId', targetEntity: OrdersSweets::class)]
    private Collection $ordersSweets;

    public function __construct()
    {
        $this->ordersSweets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalPrice(): ?int
    {
        return $this->total_price;
    }

    public function setTotalPrice(int $total_price): static
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getUid(): ?Users
    {
        return $this->uid;
    }

    public function setUid(?Users $uid): static
    {
        $this->uid = $uid;

        return $this;
    }

    /**
     * @return Collection<int, OrdersSweets>
     */
    public function getOrdersSweets(): Collection
    {
        return $this->ordersSweets;
    }

    public function addOrdersSweet(OrdersSweets $ordersSweet): static
    {
        if (!$this->ordersSweets->contains($ordersSweet)) {
            $this->ordersSweets->add($ordersSweet);
            $ordersSweet->setSweetId($this);
        }

        return $this;
    }

    public function removeOrdersSweet(OrdersSweets $ordersSweet): static
    {
        if ($this->ordersSweets->removeElement($ordersSweet)) {
            // set the owning side to null (unless already changed)
            if ($ordersSweet->getSweetId() === $this) {
                $ordersSweet->setSweetId(null);
            }
        }

        return $this;
    }
}
