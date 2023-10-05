<?php

declare(strict_types=1);

namespace Cart\Application\Find;

use Cart\Application\Find\DTO\ResponseCartsFinder;
use Cart\Domain\Repository\CartRepository;

final class CartsFinder
{
    public function __construct(
        private CartRepository $repository
    ) {
    }

    public function __invoke(): ResponseCartsFinder
    {
        $carts = $this->repository->findAll();
        return new ResponseCartsFinder(... $carts);
    }
}
