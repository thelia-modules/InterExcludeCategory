<?php

namespace InterExcludeCategory\Controller;

use InterExcludeCategory\Service\InterExcludeCategoryService;
use Thelia\Controller\Front\BaseFrontController;
use Thelia\Core\HttpFoundation\Request;

class ExcludeFromCartController extends BaseFrontController
{
    public function checkCartAction(Request $request)
    {
        /** @var InterExcludeCategoryService $iecService */
        $iecService = $this->getContainer()->get('interexcludecategory.service');

        $cartItems = $request->getSession()->getSessionCart()->getCartItems();
        $productId = $request->query->get('product_id');

        $excludingCategories = $iecService->checkProductCategory($cartItems, $productId);

        if (!empty($excludingCategories)) {
            return $this->render('includes/removeFromCart', ['excludingCategories' => $excludingCategories]);
        } else {
            return $this->render('includes/addedToCart');
        }
    }

    public function removeExcludingProductsAction(Request $request)
    {
        /** @var InterExcludeCategoryService $iecService */
        $iecService = $this->getContainer()->get('interexcludecategory.service');

        $productId = $request->query->get('product_id');
        $cart = $request->getSession()->getSessionCart();
        $cartItems = $cart->getCartItems();
        $cartItemsClone = clone($cartItems);

        $excludingCategories = $iecService->checkProductCategory($cartItems, $productId);

        foreach ($cartItemsClone as $cartItem) {
            $cartItemCategories = $iecService->getProductCategories($cartItem->getProduct()->getCategories());

            foreach ($cartItemCategories as $cartItemCategory) {
                if (in_array($cartItemCategory, $excludingCategories)) {
                    $cart->removeCartItem($cartItem);
                    continue 2;
                }
            }
        }

        $cart->save();

        return $this->generateRedirectFromRoute('default', ['view' => 'product', 'product_id' => $productId]);
    }
}
