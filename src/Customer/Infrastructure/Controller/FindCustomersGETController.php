<?php

declare(strict_types=1);

namespace Customer\Infrastructure\Controller;

use Customer\Application\Find\CustomersFinder;
use Shared\Infrastructure\Controller\SharedController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class FindCustomersGETController extends AbstractController implements SharedController
{

    public function __invoke(CustomersFinder $finder): JsonResponse
    {
        $products = $finder();
        return new JsonResponse($products->toArray(), Response::HTTP_OK);
    }

    public static function exceptions(): array
    {
        return [];
    }
}
