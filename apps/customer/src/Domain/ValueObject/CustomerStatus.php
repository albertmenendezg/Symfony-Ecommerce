<?php

declare(strict_types=1);

namespace Customer\Domain\ValueObject;

use Customer\Domain\Exception\InvalidCustomerStatus;
use Shared\Domain\ValueObject\StringValueObject;

final class CustomerStatus extends StringValueObject
{
    private const VALID_STATUS = [
        'active',
        'locked',
        'inactive'
    ];
    public function __construct(string $value)
    {
        $this->validateValidStatus($value);
        parent::__construct($value);
    }

    private function validateValidStatus(string $status): void
    {
        if (!in_array($status, self::VALID_STATUS)) {
            throw new InvalidCustomerStatus($status);
        }
    }

    public static function active(): self
    {
        return new self('active');
    }

    public static function locked(): self
    {
        return new self('locked');
    }

    public static function inactive(): self
    {
        return new self('inactive');
    }
}
