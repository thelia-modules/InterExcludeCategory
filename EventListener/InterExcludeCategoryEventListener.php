<?php

namespace InterExcludeCategory\EventListener;

use InterExcludeCategory\Service\InterExcludeCategoryService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\Cart\CartEvent;
use Thelia\Core\Event\TheliaEvents;

class InterExcludeCategoryEventListener implements EventSubscriberInterface
{
    /** @var InterExcludeCategoryService */
    protected $iecService;

    /**
     * @param InterExcludeCategoryService $iecService
     */
    public function __construct(InterExcludeCategoryService $iecService)
    {
        $this->iecService = $iecService;
    }

    public static function getSubscribedEvents()
    {
        return [
            TheliaEvents::CART_ADDITEM => ['addCartItem', 256],
        ];
    }

    /**
     * If there are some products in the cart, check that all categories the product being added belongs to
     * are not excluded by any category that a product from the cart could belong to.
     *
     * @param CartEvent $cartEvent
     */
    public function addCartItem(CartEvent $cartEvent)
    {
        $cartItems = $cartEvent->getCart()->getCartItems();
        $productId = $cartEvent->getProduct();

        if (!empty($cartItems->getData()) && null !== $productId) {
            $excludingCategories = $this->iecService->checkProductCategory($cartItems, $productId);

            if (!empty($excludingCategories)) {
                // Exclusion found: prevent adding product to cart
                $cartEvent->stopPropagation();
            }
        }
    }
}
