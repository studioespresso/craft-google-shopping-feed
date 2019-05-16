# Google Shopping Feed for Craft CMS

Get your products or entries into Google Merchant Center with a Google Shopping feed

## Requirements

This plugin requires Craft CMS 3.0.0 or later, and works out of the box when you have [Craft Commerce](http://plugins.craftcms.com/commerce) installed.

If you want to use the plugin without commerce and/or with regular entries, have a look at the [Twig functions](#twig-function) 

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project
        composer require studioespresso/craft-google-shopping-feed
        ./craft install/plugin google-shopping-feed

## Usage
Out of the box, the plugin will give you 1 feed with all your Craft Commerce products, using the default variant for each product.

If you need more control over which products show up in the feed, or you want multiple feeds, have a look at the have a look at the [Twig functions](#twig-function). 


## Twig function
If you want to use the plugin with regular entries, want to provide your own Element query or want to have mulitple feeds, have a look at these function:

### Products - craft.googleshopping.products
Works with any **Commerce Products** element query, and will use the default variant for each product

       {% set products = craft.products.limit(1) %}
       {{ craft.googleshopping.products(query) }}

### Entries - craft.googleshopping.entries
Works with any element query

       {% set query = craft.entries.section('books') %}
       {{ craft.googleshopping.entries(query) }}

Both function take an `ElementQuery` as first parameter and will use the fields mapped in the plugin settings.

An optional second parameter can be added with that contains these fixed field names and the names of the entry fields to which you want to map them.
       
       {{ craft.googleshopping.entries(products, {
            title: 'fieldHandle',
            id: 'fieldHandle',
            description: 'fieldHandle',
            image_link: 'fieldHandle',
            brand: 'fieldHandle',
            price: 'fieldHandle',
            currency: 'USD' // ISO code of the currency you want to use
       }) }}

If each of these fields are not pressent in the array, the feed will fail to validated and throw an expection. 

---
Brought to you by [Studio Espresso](https://studioespresso.co/en)
