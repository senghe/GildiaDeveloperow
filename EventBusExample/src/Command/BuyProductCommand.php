<?php

declare(strict_types=1);

namespace App\Command;

final class BuyProductCommand
{
    private int $productId;

    private int $quantity;

    public function __construct(
        int $productId,
        int $quantity
    ) {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}