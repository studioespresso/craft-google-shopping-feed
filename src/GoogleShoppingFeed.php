<?php
/**
 * Google Shopping Feed plugin for Craft CMS 3.x
 *
 * @link      https://studioespresso.co/en
 * @copyright Copyright (c) 2019 Studio Espresso
 */

namespace studioespresso\googleshoppingfeed;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use craft\events\RegisterUrlRulesEvent;
use craft\web\twig\variables\CraftVariable;
use craft\web\UrlManager;
use studioespresso\googleshoppingfeed\models\Settings;
use studioespresso\googleshoppingfeed\services\ElementsService;
use studioespresso\googleshoppingfeed\variables\GoogleShoppingFeedVariable;
use yii\base\Event;

/**
 * Class GoogleShoppingFeed
 *
 * @author    Studio Espresso
 * @package   GoogleShoppingFeed
 * @since     1.0.0
 *
 * @property ElementsService $elements
 */
class GoogleShoppingFeed extends Plugin
{
    // Static Properties
    // =========================================================================
    public static $plugin;

    // Public Properties
    // =========================================================================
    public string $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        $this->_registerRoutes();
        $this->_registerVariables();
    }

    // Protected Methods
    // =========================================================================
    /**
     * @inheritdoc
     */
    protected function createSettingsModel(): ?Model
    {
        return new Settings();
    }

    /**
     * @inheritdoc
     */
    protected function settingsHtml(): string
    {
        $fields = array_map(function($field) {
            return $fields[$field->id] = $field->name;
        }, Craft::$app->getFields()->getAllFields());
        return Craft::$app->view->renderTemplate(
            'google-shopping-feed/settings',
            [
                'settings' => $this->getSettings(),
                'fields' => Craft::$app->getFields()->getAllFields()
            ]
        );
    }

    // Private Methods
    // =========================================================================
    private function _registerRoutes()
    {
        if (Craft::$app->getPlugins()->isPluginEnabled('commerce')) {
            Event::on(
                UrlManager::class,
                UrlManager::EVENT_REGISTER_SITE_URL_RULES,
                function (RegisterUrlRulesEvent $event) {
                    $event->rules[$this->getSettings()->shoppingFeed] = 'google-shopping-feed/feed';
                }
            );
        }
    }

    private function _registerVariables()
    {
        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('googleshopping', GoogleShoppingFeedVariable::class);
            }
        );
    }
}