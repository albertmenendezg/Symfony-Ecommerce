<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class HealthCheckGETController implements SharedController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'OK'], Response::HTTP_OK);
    }

    public static function exceptions(): array
    {
        return [];
    }
}