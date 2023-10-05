<?php

declare(strict_types=1);

namespace Cart\Infrastructure\Controller;

use Cart\Application\Find\CartsFinder;
use Shared\Infrastructure\Controller\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class FindCartsGETController extends ApiController
{
    public function __invoke(
        CartsFinder $cartsFinder
    ): JsonResponse {
        $carts = $cartsFinder()->toArray();
        return new JsonResponse($carts);
    }

    public function exceptions(): array
    {
        return [];
    }
}
