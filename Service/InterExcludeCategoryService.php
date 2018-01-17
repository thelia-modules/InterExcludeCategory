<?php

namespace InterExcludeCategory\Service;

use InterExcludeCategory\Model\InterExcludeCategoryQuery;
use Thelia\Model\CartItem;
use Thelia\Model\Category;
use Thelia\Model\CategoryQuery;
use Thelia\Model\Product;
use Thelia\Model\ProductQuery;

class InterExcludeCategoryService
{
    /**
     * @param CartItem[] $cartItems
     * @param int $productId
     * @return array
     * @throws \Exception
     */
    public function checkProductCategory($cartItems, $productId)
    {
        if (null === $product = ProductQuery::create()->findOneById($productId)) {
            throw new \Exception("The product with ID $productId does not exist");
        }

        $cartProductsCategories = $this->getCartItemsCategories($cartItems);

        $addedProductCategories = $this->getAddedProductCategories($product);

        $excludingCategories = $this->compareCategories($cartProductsCategories, $addedProductCategories);

        return $excludingCategories;
    }

    /**
     * @param Category[] $productCategories
     * @return array
     */
    public function getProductCategories($productCategories)
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

    /**
     * @param CartItem[] $cartItems
     * @return array
     */
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
     * @param array $cartProductsCategories
     * @param array $addedProductCategories
     * @return array
     */
    private function compareCategories($cartProductsCategories, $addedProductCategories)
    {
        $excludingCategories = [];

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
                    $excludingCategories[] = $cartProductCategoryId;
                }
            }
        }

        return $excludingCategories;
    }
}
