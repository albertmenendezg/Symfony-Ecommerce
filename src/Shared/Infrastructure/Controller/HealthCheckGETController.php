<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class HealthCheckGETController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(null, Response::HTTP_OK);
    }
}