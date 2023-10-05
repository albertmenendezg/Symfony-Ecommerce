<?php

declare(strict_types=1);

namespace User\Application\Find;

use User\Application\Create\DTO\ResponseUserByEmailFinder;
use User\Application\Exception\UserByEmailNotFound;
use User\Application\Find\DTO\RequestUserByEmailFinder;
use User\Domain\Repository\UserRepository;
use User\Domain\ValueObject\UserEmail;

final class UserByEmailFinder
{
    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function __invoke(RequestUserByEmailFinder $request): ResponseUserByEmailFinder
    {
        $email = new UserEmail($request->email());
        $user = $this->repository->findByEmail($email);

        if (!$user) {
            throw new UserByEmailNotFound($email);
        }

        return new ResponseUserByEmailFinder($user);
    }
}
