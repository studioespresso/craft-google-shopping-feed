<?php
/**
 * Google Shopping Feed plugin for Craft CMS 3.x
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\googleshoppingfeed\controllers;

use Craft;
use craft\web\Controller;
use craft\web\View;
use studioespresso\googleshoppingfeed\GoogleShoppingFeed;

/**
 * @author    Studio Espresso
 * @package   GoogleShoppingFeed
 * @since     1.0.0
 */
class FeedController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected array|bool|int $allowAnonymous = ['index'];

    // Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $settings = GoogleShoppingFeed::getInstance()->getSettings();
        $products = GoogleShoppingFeed::getInstance()->elements->getProducts(null, $settings);
        Craft::$app->view->setTemplateMode(View::TEMPLATE_MODE_CP);

        $headers = Craft::$app->response->headers;
        $headers->add('Content-Type', 'text/xml; charset=utf-8');
        return $this->renderTemplate('google-shopping-feed/_products', [
            'products' => $products,
            'settings' => $settings
        ]);
    }

}
