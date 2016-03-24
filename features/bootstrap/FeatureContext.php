<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Mink\Driver\GoutteDriver;
use Behat\Mink\Mink;
use Behat\Mink\Session;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext {
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public $session;
    public $page;

    public function __construct() {
        $driver = new \Behat\Mink\Driver\GoutteDriver();

        $this->session = new \Behat\Mink\Session($driver);

// start the session
        $this->session->start();

        $this->page = $this->session->getPage();
    }

    /**
     * @Given I am on the homepage
     */
    public function iAmOnTheHomepage() {
        $this->session->visit("http://127.0.0.1:8000/");
        //echo $this->session->getCurrentUrl();
    }

    /**
     * @Then I should see :arg1
     */
    public function iShouldSee($arg1) {
        $el = $this->page->find("css", ".title");
        if ($el->getText() != $arg1) {
            throw new Exception();
        }

    }

    /**
     * @Given I see the menu link :arg1
     */
    public function iSeeTheMenuLink($arg1) {
        $el = $this->page->findLink($arg1);
        if ($el->getText() != $arg1) {
            throw new Exception();
        }
    }

    /**
     * @When I press the menu link :arg1
     */
    public function iPressTheMenuLink($arg1) {
        $el = $this->page->findLink($arg1);
        $el->click();
    }

    /**
     * @When I fill in :arg1 with :arg2
     */
    public function iFillInWith($arg1, $arg2) {
        $el = $this->page->findField($arg1);
        $el->setValue($arg2);
    }

    /**
     * @When I press the form button :arg1
     */
    public function iPressTheFormButton($arg1) {
        $el = $this->page->findButton($arg1);

        $el->press();
    }

    /**
     * @Then I see the title of the article :arg1
     */
    public function iSeeTheTitleOfTheArticle($arg1) {
        $elements = $this->page->findAll('css', ".article-title");
        $found = false;

        foreach ($elements as $el) {
            if ($el->getHtml() == $arg1) {
                $found = true;
            }

        }

        if ($found == false) {
            throw new Exception();
        }
    }
}
