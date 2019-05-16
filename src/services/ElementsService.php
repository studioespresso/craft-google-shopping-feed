<?php
/**
 * Google Shopping Feed plugin for Craft CMS 3.x
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\googleshoppingfeed\services;

use craft\base\Component;
use craft\commerce\elements\Product;
use craft\elements\db\ElementQuery;
use studioespresso\googleshoppingfeed\models\Settings;

/**
 * @author    Studio Espresso
 * @package   GoogleShoppingFeed
 * @since     1.0.0
 */
class ElementsService extends Component
{
    public function getProducts(ElementQuery $query = null, Settings $settings = null)
    {
        if (!$query) {
            $query = Product::find()->limit(null);
        }
        if($settings->siteId) {
            $query->siteId($settings->siteId);
        }

        return $query->all();
    }
}
