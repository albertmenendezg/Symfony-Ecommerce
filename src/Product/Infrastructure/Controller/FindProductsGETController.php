<?php

declare(strict_types=1);

namespace Product\Infrastructure\Controller;

use Product\Application\Find\ProductsFinder;
use Shared\Infrastructure\Controller\SharedController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class FindProductsGETController extends AbstractController implements SharedController
{
    public function __invoke(
        ProductsFinder $productsFinder
    ): JsonResponse {
        $products = $productsFinder()->toArray();
        return new JsonResponse($products);
    }

    public static function exceptions(): array
    {
        return [];
    }
}
