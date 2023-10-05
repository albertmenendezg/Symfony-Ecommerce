<?php

declare(strict_types=1);

namespace Customer\Infrastructure\Controller;

use Customer\Application\Create\CustomerCreator;
use Customer\Application\Create\DTO\RequestCustomerCreator;
use Shared\Infrastructure\Controller\ApiController;
use Shared\Infrastructure\Controller\ErrorMessage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

final class CreateCustomerPOSTController extends ApiController
{
    public function __invoke(
        Request $request,
        CustomerCreator $creator
    ): JsonResponse {
        $payload = json_decode($request->getContent(), true);
        $violations = self::violationsFromPayload($payload);
        if (count($violations) > 0 ) {
            return ErrorMessage::responseFromViolations($violations);
        }

        $creator(new RequestCustomerCreator(
            $payload['id'],
            $payload['userId'],
            $payload['name'],
            $payload['surname'],
        ));

        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    public function exceptions(): array
    {
        return [];
    }

    private function violationsFromPayload(array $payload): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();
        $asserts = [
            'id' => new Assert\Required([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Type('string'), new Assert\Uuid()]),
            'userId' => new Assert\Required([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Type('string'), new Assert\Uuid()]),
            'name' => new Assert\Required([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Type('string')]),
            'surname' => new Assert\Required([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Type('string')]),
        ];
        $constraints = new Collection($asserts);
        return $validator->validate($payload, $constraints);
    }
}
