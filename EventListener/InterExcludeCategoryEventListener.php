<?php

namespace InterExcludeCategory\EventListener;

use InterExcludeCategory\Model\InterExcludeCategoryQuery;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\Cart\CartEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Model\ProductQuery;

class InterExcludeCategoryEventListener implements EventSubscriberInterface
{
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

        if (!empty($cartItems->getData()) &&
            null !== $productId &&
            null !== $product = ProductQuery::create()->findOneById($productId)
        ) {
            // @TODO loop on children categories
            // Get categories of cart's products
            $cartProductsCategories = [];

            foreach ($cartItems as $cartItem) {
                $cartItemCategories = $cartItem->getProduct()->getCategories();

                foreach ($cartItemCategories as $cartItemCategory) {
                    $cartProductsCategories[] = $cartItemCategory->getId();
                }
            }

            // Get categories of the product being added to cart
            $addedProductCategories = $product->getCategories();

            foreach ($addedProductCategories as $addedProductCategory) {
                $addedProductCategoryId = $addedProductCategory->getId();

                foreach ($cartProductsCategories as $cartProductCategoryId) {
                    $interExcludeCategory = InterExcludeCategoryQuery::create()
                        ->filterByFirstCategoryId($cartProductCategoryId)
                        ->filterBySecondCategoryId($addedProductCategoryId)
                        ->find();

                    // Check both first/second and second/first combinations
                    if (empty($interExcludeCategory->getData())) {
                        $interExcludeCategory = InterExcludeCategoryQuery::create()
                            ->filterByFirstCategoryId($addedProductCategoryId)
                            ->filterBySecondCategoryId($cartProductCategoryId)
                            ->find();
                    }

                    if (!empty($interExcludeCategory->getData())) {
                        // Exclusion found: prevent adding product to cart
                        $a = 'ici';
                    }
                }
            }
        }
    }
}
