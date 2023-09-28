<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObject;

use DateTimeImmutable;
use Exception;
use Shared\Domain\Exception\InvalidDateTime;

class DateTimeValueObject
{
    const DATE_FORMAT = DATE_ATOM;
    protected DateTimeImmutable $value;

    /**
     * @throws Exception
     */
    public function __construct(string $value = null)
    {
        if (!is_null($value)) {
            $this->ensureValidFormat($value);
            $this->value = DateTimeImmutable::createFromFormat(self::DATE_FORMAT, $value);
        } else {
            $this->value = new DateTimeImmutable();
        }
    }

    private function ensureValidFormat(string $value): void
    {
        if (!DateTimeImmutable::createFromFormat(self::DATE_FORMAT, $value)) {
            throw new InvalidDateTime($value);
        }
    }

    public function value(): DateTimeImmutable
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value->format(self::DATE_FORMAT);
    }
}
