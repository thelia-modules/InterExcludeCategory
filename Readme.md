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

## Hook

If your module use one or more hook, fill this part. Explain which hooks are used.


## Loop

If your module declare one or more loop, describe them here like this :

[loop name]

### Input arguments

|Argument |Description |
|---      |--- |
|**arg1** | describe arg1 with an exemple. |
|**arg2** | describe arg2 with an exemple. |

### Output arguments

|Variable   |Description |
|---        |--- |
|$VAR1    | describe $VAR1 variable |
|$VAR2    | describe $VAR2 variable |

### Exemple

Add a complete exemple of your loop

## Other ?

If you have other think to put, feel free to complete your readme as you want.
