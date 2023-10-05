<?php

declare(strict_types=1);

namespace User\Infrastructure\Controller;

use Shared\Infrastructure\Controller\ApiController;
use Shared\Infrastructure\Controller\ErrorMessage;
use Shared\Infrastructure\Controller\Exception\InvalidBodyRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;
use User\Application\Create\DTO\RequestUserCredentialPasswordCreator;
use User\Application\Create\UserCredentialPasswordCreator;

final class CreateUserPOSTController extends ApiController
{
    /**
     * @throws InvalidBodyRequest
     */
    public function __invoke(
        Request $request,
        UserCredentialPasswordCreator $userCredentialPasswordCreator
    ): JsonResponse {
        $payload = json_decode($request->getContent(), true);
        if (isset($payload['password'])) {
            $violations = $this->violationsFromPayloadPassword($payload);
            if (count($violations) >  0) {
                return ErrorMessage::responseFromViolations($violations);
            }
            $userCredentialPasswordCreator(
                new RequestUserCredentialPasswordCreator(
                    $payload['id'],
                    $payload['email'],
                    $payload['password']
                )
            );
        } else {
            throw new InvalidBodyRequest('The body request should contain password');
        }

        return new JsonResponse(null, Response::HTTP_CREATED);
    }
    public function violationsFromPayloadPassword(array $payload): ConstraintViolationListInterface
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
            'email' => [
                new Assert\Required(),
                new Assert\NotBlank(),
                new Assert\NotNull(),
                new Assert\Type('string'),
                new Assert\Email(),
            ],
            'password' => [
                new Assert\Required(),
                new Assert\NotBlank(),
                new Assert\NotNull(),
                new Assert\Type('string'),
            ],
        ];
        $constraints = new Collection($asserts);
        return $validator->validate($payload, $constraints);
    }

    public function exceptions(): array
    {
        return [
            InvalidBodyRequest::class => Response::HTTP_BAD_REQUEST,
        ];
    }
}
