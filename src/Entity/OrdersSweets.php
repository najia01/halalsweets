<?php

namespace App\Entity;

use App\Repository\OrdersSweetsRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Orders;
use App\Entity\Sweets;

#[ORM\Entity(repositoryClass: OrdersSweetsRepository::class)]
class OrdersSweets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'ordersSweets')]
    private ?Orders $order = null;

    #[ORM\ManyToOne(inversedBy: 'ordersSweets')]
    private ?Sweets $sweet = null;

    #[ORM\Column]
    private ?int $quantity = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrder(): ?Orders
    {
        return $this->order;
    }

    public function setOrder(?Orders $order): static
    {
        $this->order = $order;

        return $this;
    }

    public function getSweet(): ?Sweets
    {
        return $this->sweet;
    }

    public function setSweet(?Sweets $sweet): static
    {
        $this->sweet = $sweet;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }
}
