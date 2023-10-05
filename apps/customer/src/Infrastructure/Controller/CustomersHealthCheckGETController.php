<?php

declare(strict_types=1);

namespace Customer\Infrastructure\Controller;

use Shared\Infrastructure\Controller\ApiController;
use Symfony\Component\HttpFoundation\JsonResponse;

final class CustomersHealthCheckGETController extends ApiController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['message' => 'Module Customers up and running']);
    }

    public function exceptions(): array
    {
        return [];
    }
}
