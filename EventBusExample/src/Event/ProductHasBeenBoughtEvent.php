<?php

declare(strict_types=1);

namespace App\Event;

final class ProductHasBeenBoughtEvent
{
    private int $productId;

    public function __construct(int $productId)
    {
        $this->productId = $productId;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}