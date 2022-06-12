<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Event\ProductHasBeenBoughtEvent;
use App\Repository\ProductRepository;
use LogicException;

final class DisableOutOfStockProductEventSubscriber
{
    private ProductRepository $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function __invoke(ProductHasBeenBoughtEvent $event)
    {
        $product = $this->productRepository->find($event->getProductId());

        if ($product === null) {
            throw new LogicException(sprintf('Product with ID %d has not been found', $event->getProductId()));
        }

        if ($product->quantity === 0) {
            $product->enabled = false;
        }
    }
}