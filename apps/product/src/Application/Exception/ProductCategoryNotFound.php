<?php

declare(strict_types=1);

namespace Product\Application\Exception;

use DomainException;
use Product\Domain\ValueObject\ProductCategoryId;

final class ProductCategoryNotFound extends DomainException
{
    public function __construct(ProductCategoryId $id)
    {
        parent::__construct(sprintf("Could not find product category with id %s", $id->value()));
    }
}
