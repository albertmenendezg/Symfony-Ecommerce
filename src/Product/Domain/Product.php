<?php

declare(strict_types=1);

namespace Product\Domain;

use Product\Domain\Event\ProductWasCreated;
use Product\Domain\ValueObject\ProductCreatedAt;
use Product\Domain\ValueObject\ProductDescription;
use Product\Domain\ValueObject\ProductName;
use Product\Domain\ValueObject\ProductPrice;
use Product\Domain\ValueObject\ProductStock;
use Product\Domain\ValueObject\ProductUpdatedAt;
use Shared\Domain\AggregateRoot;
use Shared\Domain\ValueObject\ProductId;

final class Product extends AggregateRoot
{
    public function __construct(
        private ProductId $id,
        private ProductName $name,
        private ProductDescription $description,
        private ProductStock $stock,
        private ProductPrice $price,
        private ProductCreatedAt $createdAt,
        private ProductUpdatedAt $updatedAt,
    ) {
    }

    public static function create(
        ProductId $id,
        ProductName $name,
        ProductDescription $description,
        ProductStock $stock,
        ProductPrice $price,
    ): self {

        $product = new self (
            $id,
            $name,
            $description,
            $stock,
            $price,
            new ProductCreatedAt(),
            new ProductUpdatedAt(),
        );

        $product->record(
            new ProductWasCreated(
                $product->id->value(),
                $product->toArray()
            )
        );

        return $product;
    }

    public function id(): ProductId
    {
        return $this->id;
    }

    public function name(): ProductName
    {
        return $this->name;
    }

    public function description(): ProductDescription
    {
        return $this->description;
    }

    public function stock(): ProductStock
    {
        return $this->stock;
    }

    public function price(): ProductPrice
    {
        return $this->price;
    }

    public function createdAt(): ProductCreatedAt
    {
        return $this->createdAt;
    }

    public function updatedAt(): ProductUpdatedAt
    {
        return $this->updatedAt;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'description' => $this->description->value(),
            'stock' => $this->stock->value(),
            'price' => $this->price->value(),
            'created_at' => $this->createdAt->__toString(),
            'updated_at' => $this->updatedAt->__toString(),
        ];
    }
}
