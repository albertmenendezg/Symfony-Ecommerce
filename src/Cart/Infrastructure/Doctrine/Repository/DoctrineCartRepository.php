<?php

declare(strict_types=1);

namespace Cart\Infrastructure\Doctrine\Repository;

use Cart\Domain\Cart;
use Cart\Domain\Repository\CartRepository;
use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;

final class DoctrineCartRepository extends DoctrineAbstractRepository implements CartRepository
{

    public function entityRepositoryClass(): string
    {
        return Cart::class;
    }

    public function entityManagerName(): string
    {
        return 'carts_em';
    }
    public function save(Cart $cart): void
    {
        $this->em()->persist($cart);
        $this->em()->flush();
    }

    public function remove(Cart $cart): void
    {
        $this->em()->remove($cart);
        $this->em()->flush();
    }

    /**
     * @return Cart[]
     */
    public function findAll(): iterable
    {
        return $this->repository()->findAll();
    }
}
