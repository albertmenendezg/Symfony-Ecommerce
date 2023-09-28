<?php

declare(strict_types=1);

namespace Product\Domain;

use Product\Domain\Event\CategoryWasCreated;
use Product\Domain\ValueObject\CategoryId;
use Product\Domain\ValueObject\CategoryName;
use Shared\Domain\AggregateRoot;

final class Category extends AggregateRoot
{
    public function __construct(
        private CategoryId $id,
        private CategoryName $name
    ) {
    }

    public static function create (
        CategoryId $id,
        CategoryName $name,
    ): Category {
        $category = new self($id, $name);

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
            'name' => $this->name->value()
        ];
    }

    public function id(): CategoryId
    {
        return $this->id;
    }

    public function name(): CategoryName
    {
        return $this->name;
    }
}
