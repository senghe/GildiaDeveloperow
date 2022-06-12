<?php

declare(strict_types=1);

namespace App\CommandHandler;

use App\Command\BuyProductCommand;
use App\Entity\Product;
use App\Event\ProductHasBeenBoughtEvent;
use App\Repository\ProductRepository;
use LogicException;
use Symfony\Component\Messenger\MessageBusInterface;

final class BuyProductCommandHandler
{
    private MessageBusInterface $eventBus;

    private ProductRepository $productRepository;

    public function __construct(
        MessageBusInterface $eventBus,
        ProductRepository $productRepository
    ) {
        $this->eventBus = $eventBus;
        $this->productRepository = $productRepository;
    }

    public function __invoke(BuyProductCommand $command): void
    {
        $product = $this->productRepository->find($command->getProductId());

        /** @var Product */
        if ($product === null) {
            throw new LogicException(sprintf('Product with ID %d has not been found', $command->getProductId()));
        }

        if ($product->quantity < $command->getQuantity()) {
            throw new LogicException(sprintf('Not enough quantity. You can buy at most %s', $product->quantity));
        }

        $product->quantity -= $command->getQuantity();

        $this->eventBus->dispatch(
            new ProductHasBeenBoughtEvent($command->getProductId())
        );
    }
}