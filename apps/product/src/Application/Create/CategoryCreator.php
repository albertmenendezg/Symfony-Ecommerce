<?php

declare(strict_types=1);

namespace Product\Application\Create;

use Product\Application\Create\DTO\RequestCategoryCreator;
use Product\Domain\Category;
use Product\Domain\Repository\CategoryRepository;
use Product\Domain\ValueObject\CategoryId;
use Product\Domain\ValueObject\CategoryName;
use Shared\Domain\Event\DomainEventPublisher;

final class CategoryCreator
{
    public function __construct(
        private CategoryRepository $repository,
        private DomainEventPublisher $publisher,
    ) {
    }

    public function __invoke(RequestCategoryCreator $request): void
    {
        $category = Category::create(
            new CategoryId($request->id()),
            new CategoryName($request->name()),
        );

        $this->repository->save($category);
        $this->publisher->publish(... $category->pullDomainEvents());
    }
}
