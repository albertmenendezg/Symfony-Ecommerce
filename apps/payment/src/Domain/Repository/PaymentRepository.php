<?php

namespace Payment\Domain\Repository;

use Payment\Domain\Payment;

interface PaymentRepository
{
    public function save(Payment $payment): void;

    public function remove(Payment $payment): void;

    /**
     * @return Payment[]
     */
    public function findAll(): iterable;
}