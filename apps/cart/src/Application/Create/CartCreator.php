<?php

declare(strict_types=1);

namespace Cart\Application\Create;

use Cart\Application\Create\DTO\RequestCartCreator;
use Cart\Application\Create\DTO\RequestCartItemCreator;
use Cart\Domain\Cart;
use Cart\Domain\CartItem;
use Cart\Domain\Repository\CartItemRepository;
use Cart\Domain\Repository\CartRepository;
use Cart\Domain\ValueObject\CartId;
use Cart\Domain\ValueObject\CartItemId;
use Cart\Domain\ValueObject\CartItemQuantity;
use Shared\Domain\Event\DomainEventPublisher;
use Shared\Domain\ValueObject\CustomerId;
use Shared\Domain\ValueObject\ProductId;

final class CartCreator
{
    public function __construct(
        private CartRepository $cartRepository,
        private CartItemRepository $cartItemRepository,
        private DomainEventPublisher $publisher,
    ) {
    }

    public function __invoke(
        RequestCartCreator $request
    ): void {

        $cart = Cart::create(
            new CartId($request->id()),
            new CustomerId($request->customerId()),
        );

        $this->cartRepository->save($cart);

        /**
         * @var $requestItem RequestCartItemCreator
         */
        foreach ($request->requestsCartItem() as $requestItem) {
            $item = CartItem::create(
                CartItemId::random(),
                $cart,
                new ProductId($requestItem->productId()),
                new CartItemQuantity($requestItem->quantity())
            );

            $this->cartItemRepository->save($item);
            $this->publisher->publish(... $item->pullDomainEvents());
        }

        $this->publisher->publish(... $cart->pullDomainEvents());
    }
}
