<?php

declare(strict_types=1);

namespace Product\Infrastructure\Controller;

use Product\Application\Exception\ProductByIdNotFound;
use Product\Application\Find\DTO\RequestProductByIdFinder;
use Product\Application\Find\ProductByIdFinder;
use Shared\Domain\Exception\InvalidUuid;
use Shared\Infrastructure\Controller\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class FindProductByIdGETController extends ApiController
{
    /**
     * @throws ProductByIdNotFound
     */
    public function __invoke(
        string $id,
        ProductByIdFinder $finder
    ): JsonResponse {
        $product = $finder(
            new RequestProductByIdFinder (
                $id
            )
        )->product();
        return new JsonResponse($product->toArray());
    }

    public function exceptions(): array
    {
        return [
            ProductByIdNotFound::class => Response::HTTP_NOT_FOUND,
            InvalidUuid::class => Response::HTTP_BAD_REQUEST,
        ];
    }
}
