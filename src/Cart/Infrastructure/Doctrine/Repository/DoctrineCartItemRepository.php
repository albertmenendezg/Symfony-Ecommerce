<?php

declare(strict_types=1);

namespace Cart\Infrastructure\Doctrine\Repository;

use Cart\Domain\CartItem;
use Cart\Domain\Repository\CartItemRepository;
use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;

final class DoctrineCartItemRepository extends DoctrineAbstractRepository implements CartItemRepository
{
    public function entityRepositoryClass(): string
    {
        return CartItem::class;
    }

    public function entityManagerName(): string
    {
        return 'carts_em';
    }

    public function save(CartItem $item): void
    {
        $this->em()->persist($item);
        $this->em()->flush();
    }

    public function remove(CartItem $item): void
    {
        $this->em()->remove($item);
        $this->em()->flush();
    }

    public function findAll(): iterable
    {
        return $this->repository()->findAll();
    }
}
