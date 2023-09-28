<?php

declare(strict_types=1);

namespace Payment\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Payment\Domain\Payment;
use Payment\Domain\Repository\PaymentRepository;
use Shared\Infrastructure\Doctrine\DoctrineAbstractRepository;

final class PaymentDoctrineRepository extends DoctrineAbstractRepository implements PaymentRepository
{
    function entityRepositoryClass(): string
    {
        return Payment::class;
    }

    public function save(Payment $payment): void
    {
        $this->em()->persist($payment);
        $this->em()->flush();
    }

    public function remove(Payment $payment): void
    {
        $this->em()->remove($payment);
        $this->em()->flush();
    }

    /**
     * @return Payment[]
     */
    public function findAll(): iterable
    {
        return $this->repository()->findAll();
    }

    function entityManagerName(): string
    {
        return 'payments_em';
    }
}
