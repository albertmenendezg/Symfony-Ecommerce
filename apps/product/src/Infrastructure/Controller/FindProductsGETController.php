<?php

declare(strict_types=1);

namespace Product\Infrastructure\Controller;

use Product\Application\Find\ProductsFinder;
use Shared\Infrastructure\Controller\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class FindProductsGETController extends ApiController
{
    public function __invoke(
        ProductsFinder $productsFinder
    ): JsonResponse {
        $products = $productsFinder()->toArray();
        return new JsonResponse($products);
    }

    public function exceptions(): array
    {
        return [];
    }
}
