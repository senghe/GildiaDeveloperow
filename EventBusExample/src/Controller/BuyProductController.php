<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\BuyProductCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;

final class BuyProductController
{
    private MessageBusInterface $commandBus;

    public function __construct(
        MessageBusInterface $commandBus
    ) {
        $this->commandBus = $commandBus;
    }

    public function __invoke(Request $request): Response
    {
        $productId = (int)$request->get('id', 0);
        $quantity = (int)$request->get('quantity', 0);

        if ($quantity <= 0) {
            return new JsonResponse([
                'status' => 'error',
                'error' => 'Expected quantity greater than zero'
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $this->commandBus->dispatch(
                new BuyProductCommand($productId, $quantity)
            );

            return new JsonResponse([
                'status' => 'ok',
            ]);
        } catch (HandlerFailedException $exception) {
            return new JsonResponse([
                'status' => 'error',
                'error' => $exception->getPrevious()->getMessage()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}