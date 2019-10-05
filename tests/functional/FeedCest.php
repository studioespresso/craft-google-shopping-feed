<?php

namespace myprojecttests;

use Craft;
use craft\elements\User;
use FunctionalTester;


class FeedCest
{

    /**
     * @var string
     */
    public $cpTrigger;

    /**
     * @var
     */
    public $currentUser;

    // Public methods
    // =========================================================================
    public function _before(FunctionalTester $I)
    {
        $this->currentUser = User::find()
            ->admin()
            ->one();
        $I->amLoggedInAs($this->currentUser);
        $this->cpTrigger = Craft::$app->getConfig()->getGeneral()->cpTrigger;
    }

    public function testFeed(FunctionalTester $I)
    {
        $I->amOnPage('/' . $this->cpTrigger . '/settings/plugins/google-shopping-feed');
        $I->submitForm('#main-form', [
            'settings[shoppingFeed]' => 'feeds/products/google',
            'settings[brand]' => 'title',
            'settings[description]' => 'title',
            'settings[image_link]' => 'title',
        ]);

        Craft::$app->getPlugins()->switchEdition('commerce', 'pro');
        $I->amOnPage('/feeds/products/google');
    }
}
