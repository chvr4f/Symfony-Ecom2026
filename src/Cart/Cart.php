<?php

namespace App\Cart;

class Cart
{
    /** @var CartItem[] */
    private array $cartItems = [];

    public function __construct(
        private string $id,
        private \DateTimeInterface $createdAt
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @return CartItem[]
     */
    public function getCartItems(): array
    {
        return $this->cartItems;
    }

    public function addItem(CartItem $item): void
    {
        foreach ($this->cartItems as $existingItem) {
            if ($existingItem->getProduct()->getId() === $item->getProduct()->getId()) {
                $existingItem->addQuantity($item->getQuantity());
                return;
            }
        }
        $this->cartItems[] = $item;
    }

    public function removeItem(CartItem $item): void
    {
        foreach ($this->cartItems as $index => $existingItem) {
            if ($existingItem->getProduct()->getId() === $item->getProduct()->getId()) {
                unset($this->cartItems[$index]);
            }
        }
        $this->cartItems = array_values($this->cartItems);
    }

    public function total(): float
    {
        $total = 0.0;
        foreach ($this->cartItems as $item) {
            $total += $item->getPrice() * $item->getQuantity();
        }
        return $total;
    }
}
