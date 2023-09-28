<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class ErrorMessage
{
    public static function responseFromViolations(ConstraintViolationListInterface $violationList): JsonResponse
    {
        $violationMessage = [];
        foreach ($violationList as $violation) {
            $violationMessage[] = [
                'error_type' => 'invalid_argument',
                'message' =>
                    "{$violation->getPropertyPath()}: {$violation->getMessage()} {$violation->getInvalidValue()}"
            ];
        }
        return new JsonResponse($violationMessage, Response::HTTP_BAD_REQUEST);
    }
}
