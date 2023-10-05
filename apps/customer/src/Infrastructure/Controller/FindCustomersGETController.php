<?php

declare(strict_types=1);

namespace Customer\Infrastructure\Controller;

use Customer\Application\Find\CustomersFinder;
use Shared\Infrastructure\Controller\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class FindCustomersGETController extends ApiController
{

    public function __invoke(CustomersFinder $finder): JsonResponse
    {
        $products = $finder();
        return new JsonResponse($products->toArray(), Response::HTTP_OK);
    }

    public function exceptions(): array
    {
        return [];
    }
}
