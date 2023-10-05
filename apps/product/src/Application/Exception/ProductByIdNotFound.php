<?php

declare(strict_types=1);

namespace Product\Application\Exception;

use Exception;

final class ProductByIdNotFound extends Exception
{
    public function __construct(string $id)
    {
        parent::__construct("Could not find product with id $id");
    }
}
