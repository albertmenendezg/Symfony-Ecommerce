<?php

declare(strict_types=1);

namespace Product\Domain;

use Product\Domain\Event\CategoryWasCreated;
use Product\Domain\ValueObject\ProductCategoryCreatedAt;
use Product\Domain\ValueObject\ProductCategoryId;
use Product\Domain\ValueObject\ProductCategoryName;
use Product\Domain\ValueObject\ProductCategoryUpdatedAt;
use Shared\Domain\AggregateRoot;

final class ProductCategory extends AggregateRoot
{
    public function __construct(
        private ProductCategoryId $id,
        private ProductCategoryName $name,
        private ProductCategoryCreatedAt $createdAt,
        private ProductCategoryUpdatedAt $updatedAt,
    ) {
    }

    public static function create (
        ProductCategoryId $id,
        ProductCategoryName $name,
    ): self {

        $category = new self (
            $id,
            $name,
            new ProductCategoryCreatedAt(),
            new ProductCategoryUpdatedAt(),
        );

        $category->record(
            new CategoryWasCreated (
                $category->id->value(),
                $category->toArray()
            )
        );

        return $category;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'createdAt' => $this->createdAt->__toString(),
            'updatedAt' => $this->updatedAt->__toString(),
        ];
    }

    public function id(): ProductCategoryId
    {
        return $this->id;
    }

    public function name(): ProductCategoryName
    {
        return $this->name;
    }

    public function createdAt(): ProductCategoryCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ProductCategoryUpdatedAt
    {
        return $this->updatedAt;
    }
}
