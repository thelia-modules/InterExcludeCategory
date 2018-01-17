# Inter Exclude Category

Define categories from which products cannot be put in cart together.

## Installation

### Manually

* Copy the module into ```<thelia_root>/local/modules/``` directory and be sure that the name of the module is InterExcludeCategory.
* Activate it in your thelia administration panel

### Composer

Add it in your main thelia composer.json file

```
composer require thelia/inter-exclude-category-module:~1.0
```

## Usage

In the plugin's configuration page, select 2 categories from which products must not be put together in the cart.

You can add as many exclusions as you want, but it's not possible to exclude a category and one of its parents.

When trying to add a product to the cart if there is already a product from an excluding category, user will be prompted not to add this product or to remove products of the excluding category from his cart.

## Integration

In the bottom script of your FO template layout, change the `var addCartMessageUrl = "{url path='ajax/addCartMessage'}";` declaration by `var addCartMessageUrl = "{url path='InterExcludeCategory/check-cart'}";` in order to have the popup displayed when trying to add a product in the cart while a product from a excluding category is already in.

Think about customizing the `includes/removeFromCart.html` file in your template.
