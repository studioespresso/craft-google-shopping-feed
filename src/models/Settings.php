<?php
/**
 * Google Shopping Feed plugin for Craft CMS 3.x
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\googleshoppingfeed\models;


use craft\base\Model;

/**
 * @author    Studio Espresso
 * @package   GoogleShoppingFeed
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $shoppingFeed = '/feeds/products/google';

    public $id = 'sku';

    public $siteId;

    public $title = 'title';

    public $price = 'price';

    public $availability = 'in stock';

    public $description;

    public $image_link;

    public $brand;

    public $brandCustom;

    public $currencyIso;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['shoppingFeed', 'required'],
            ['description', 'required'],
            ['image_link', 'required'],
            ['brand', 'required'],
        ];
    }

}
