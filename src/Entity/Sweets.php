<?php

namespace App\Entity;

use App\Repository\SweetsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Category;
use App\Entity\OrdersSweets;



#[ORM\Entity(repositoryClass: SweetsRepository::class)]
class Sweets
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    private ?string $thumbnail = null;

    #[ORM\ManyToMany(targetEntity: OrdersSweets::class, mappedBy: 'sweet')]
    private Collection $ordersSweets;


    #[ORM\OneToMany(targetEntity: Category::class, mappedBy: "sweets")]
    private Collection $categories;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id')]
    private ?Category $category = null;

    #[ORM\ManyToMany(targetEntity: Cart::class, mappedBy: 'items')]
    private Collection $carts;

    public function __construct()
    {
        $this->ordersSweets = new ArrayCollection();
        $this->carts = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * @return Collection<int, OrdersSweets>
     */
    public function getOrdersSweets(): Collection
    {
        return $this->ordersSweets;
    }

    public function addOrdersSweet(OrdersSweets $ordersSweet): self
    {
        if (!$this->ordersSweets->contains($ordersSweet)) {
            $this->ordersSweets->add($ordersSweet);
            $ordersSweet->setSweet($this);
        }

        return $this;
    }

    public function removeOrdersSweet(OrdersSweets $ordersSweet): self
    {
        if ($this->ordersSweets->removeElement($ordersSweet)) {
            // set the owning side to null (unless already changed)
            if ($ordersSweet->getSweet() === $this) {
                $ordersSweet->setSweet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addSweet($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        $this->categories->removeElement($category);
        $category->removeSweet($this);

        return $this;
    }

    /**
     * @return Collection<int, Cart>
     */
    public function getCarts(): Collection
    {
        return $this->carts;
    }

    public function addCart(Cart $cart): static
    {
        if (!$this->carts->contains($cart)) {
            $this->carts->add($cart);
            $cart->addItem($this);
        }

        return $this;
    }

    public function removeCart(Cart $cart): static
    {
        if ($this->carts->removeElement($cart)) {
            $cart->removeItem($this);
        }

        return $this;
    }
}
