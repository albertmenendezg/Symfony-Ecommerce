<?php

declare(strict_types=1);

namespace Product\Infrastructure\Controller;

use Product\Application\Create\DTO\RequestProductCreator;
use Product\Application\Create\ProductCreator;
use Shared\Infrastructure\Controller\ApiController;
use Shared\Infrastructure\Controller\ErrorMessage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

final class CreateProductPOSTController extends ApiController
{

    public function __invoke(
        Request $request,
        ProductCreator $creator
    ): JsonResponse {
        $payload = json_decode($request->getContent(), true);
        $violations = self::violationsFromPayload($payload);
        if (count($violations) > 0) {
            return ErrorMessage::responseFromViolations($violations);
        }

        $creator (
            new RequestProductCreator (
                $payload['id'],
                $payload['name'],
                $payload['description'],
                $payload['stock'],
                $payload['price'],
                $payload['categoryId']
            )
        );
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
            'name' => new Assert\Required([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Type('string')]),
            'description' => new Assert\Required([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Type('string')]),
            'stock' => new Assert\Required([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Type('integer')]),
            'price' => new Assert\Required([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Type('float')]),
            'categoryId' => new Assert\Required([new Assert\NotBlank(), new Assert\NotNull(), new Assert\Type('string'), new Assert\Uuid()]),
        ];
        $constraints = new Collection($asserts);
        return $validator->validate($payload, $constraints);
    }
}
