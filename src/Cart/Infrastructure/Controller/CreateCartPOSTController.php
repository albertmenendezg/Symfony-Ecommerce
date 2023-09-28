<?php

declare(strict_types=1);

namespace Cart\Infrastructure\Controller;

use Cart\Application\Create\CartCreator;
use Cart\Application\Create\DTO\RequestCartCreator;
use Cart\Application\Create\DTO\RequestCartItemCreator;
use Shared\Infrastructure\Controller\ErrorMessage;
use Shared\Infrastructure\Controller\SharedController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

final class CreateCartPOSTController extends AbstractController implements SharedController
{
    public function __invoke(
        Request $request,
        CartCreator $cartCreator
    ): JsonResponse {

        $payload = json_decode($request->getContent(), true);
        $violations = self::violationsFromPayload($payload);
        if (count($violations) > 0) {
            return ErrorMessage::responseFromViolations($violations);
        }

        $requestsItems = [];
        foreach ($payload['items'] as $item) {
            $requestsItems[] = new RequestCartItemCreator (
                $item['productId'],
                $item['quantity']
            );
        }

        $cartCreator (
            new RequestCartCreator (
                $payload['id'],
                $payload['customerId'],
                $requestsItems
            )
        );

        return new JsonResponse(null, Response::HTTP_CREATED);
    }

    public static function exceptions(): array
    {
        return [];
    }
        private function violationsFromPayload(array $payload): ConstraintViolationListInterface
    {
        $validator = Validation::createValidator();

        $asserts = [
            'id' => [
                new Assert\Required(),
                new Assert\NotBlank(),
                new Assert\NotNull(),
                new Assert\Type('string'),
                new Assert\Uuid(),
            ],
            'customerId' => [
                new Assert\Required(),
                new Assert\NotBlank(),
                new Assert\NotNull(),
                new Assert\Type('string'),
                new Assert\Uuid(),
            ],
            'items' => [
                new Assert\Required(),
                new Assert\NotNull(),
            ],
        ];

        $constraints = new Collection($asserts);
        return $validator->validate($payload, $constraints);
    }
}
