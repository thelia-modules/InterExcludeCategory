<?php

namespace InterExcludeCategory\EventListener;

use InterExcludeCategory\Model\InterExcludeCategoryQuery;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Thelia\Core\Event\Cart\CartEvent;
use Thelia\Core\Event\TheliaEvents;
use Thelia\Model\CartItem;
use Thelia\Model\Category;
use Thelia\Model\CategoryQuery;
use Thelia\Model\Product;
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
            $cartProductsCategories = $this->getCartItemsCategories($cartItems);

            $addedProductCategories = $this->getAddedProductCategories($product);

            $this->compareCategories($cartProductsCategories, $addedProductCategories);
        }
    }
    
    private function getCartItemsCategories($cartItems)
    {
        $cartProductsCategories = [];

        /** @var CartItem $cartItem */
        foreach ($cartItems as $cartItem) {
            $cartItemCategories = $cartItem->getProduct()->getCategories();

            $cartProductsCategories = array_merge(
                $cartProductsCategories,
                $this->getProductCategories($cartItemCategories)
            );
        }

        return array_unique($cartProductsCategories);
    }

    /**
     * @param Product $product
     * @return array
     */
    private function getAddedProductCategories($product)
    {
        $productCategories = $product->getCategories();

        return array_unique($this->getProductCategories($productCategories));
    }

    /**
     * @param $productCategories
     * @return array
     */
    private function getProductCategories($productCategories)
    {
        $productCategoriesArray = [];

        /** @var Category $category */
        foreach ($productCategories as $category) {
            $productCategoriesArray[] = $category->getId();
            $parentCategoryId = $category->getParent();

            while (0 != $parentCategoryId) {
                $productCategoriesArray[] = $parentCategoryId;

                $parentCategoryId = CategoryQuery::create()
                    ->filterById($parentCategoryId)
                    ->select('parent')
                    ->findOne();
            }
        }

        return $productCategoriesArray;
    }

    private function compareCategories($cartProductsCategories, $addedProductCategories)
    {
        foreach ($cartProductsCategories as $cartProductCategoryId) {
            foreach ($addedProductCategories as $addedProductCategoryId) {
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
