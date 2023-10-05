<?php

declare(strict_types=1);

namespace User\Application\Create;

use Shared\Domain\Event\DomainEventPublisher;
use Shared\Domain\ValueObject\UserId;
use User\Application\Create\DTO\RequestUserCredentialPasswordCreator;
use User\Domain\Repository\UserCredentialRepository;
use User\Domain\Repository\UserRepository;
use User\Domain\User;
use User\Domain\UserCredential;
use User\Domain\ValueObject\UserCredentialId;
use User\Domain\ValueObject\UserEmail;
use User\Domain\ValueObject\UserPlainPassword;

final class UserCredentialPasswordCreator
{
    public function __construct(
        private UserRepository $userRepository,
        private UserCredentialRepository $credentialRepository,
        private DomainEventPublisher $publisher,
    ) {
    }

    public function __invoke(RequestUserCredentialPasswordCreator $request): void
    {
        $user = User::create (
            new UserId($request->id()),
            new UserEmail($request->email())
        );

        $credential = UserCredential::createPassword (
            UserCredentialId::random(),
            $user,
            new UserPlainPassword (
                $request->password(),
            )
        );

        $user->addCredential($credential);

        $this->userRepository->save($user);
        $this->credentialRepository->save($credential);

        $this->publisher->publish(... $user->pullDomainEvents());
        $this->publisher->publish(... $credential->pullDomainEvents());
    }
}
