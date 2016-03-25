<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
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

        $driver = new \Behat\Mink\Driver\Selenium2Driver('firefox');

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

        $this->session->stop();
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
        $el = $this->page->findById('save-article-btn');
        $el->press();
    }

    /**
     * @Then I see the title of the article :arg1
     */
    public function iSeeTheTitleOfTheArticle($arg1) {
        $elements = $this->page->findAll('css', ".article-title");
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getHtml() == $arg1) {
                $found = true;
            }
            $i++;
        }

        if ($found == false) {
            throw new Exception();
        }

        $this->session->stop();
    }

    /**
     * @Given I see the link named :arg1
     */
    public function iSeeTheLinkNamed($arg1) {
        $el = $this->page->findLink($arg1);
        if ($el->getText() != $arg1) {
            throw new Exception();
        }
    }
    /**
     * @When I press the read more link :arg1
     */
    public function iPressTheReadMoreLink($arg1) {
        $elements = $this->page->findAll("css", '.article-link');
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getAttribute('href') == $arg1) {
                $elements[$i]->click();
                $found = true;
            }
            $i++;
        }
    }

    /**
     * @Then I should see the page of the article :arg1
     */
    public function iShouldSeeThePageOfTheArticle($arg1) {
        if ($this->session->getCurrentUrl() != $arg1) {
            throw new Exception();
        }

        $this->session->stop();
    }

    /**
     * @Given I see the delete button :arg1 with the link :arg2
     */
    public function iSeeTheDeleteButtonWithTheLink($arg1, $arg2) {
        $elements = $this->page->findAll('css', ".delete-article");
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getAttribute("data-article") == $arg2) {
                $found = true;
            }
            $i++;
        }
    }

    /**
     * @When I press the delete button :arg1 with the link :arg2
     */
    public function iPressTheDeleteButtonWithTheLink($arg1, $arg2) {
        $elements = $this->page->findAll('css', ".delete-article");
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getAttribute("data-article") == $arg2) {
                $elements[$i]->click();
                $found = true;
            }
            $i++;
        }
    }

    /**
     * @Then I should not see the article :arg1
     */
    public function iShouldNotSeeTheArticle($arg1) {
        $this->session->wait(2000, null);
        $elements = $this->page->findAll('css', ".article-title");
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getHtml() == $arg1) {
                $found = true;
                throw new Exception();
            }
            $i++;
        }

        $this->session->stop();
    }

    /**
     * @Given I see the archive button :arg1 with the link :arg2
     */
    public function iSeeTheArchiveButtonWithTheLink($arg1, $arg2) {
        $elements = $this->page->findAll('css', ".archive-article");
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getAttribute("data-article") == $arg2) {
                $found = true;
            }
            $i++;
        }
    }

    /**
     * @When I press the archive button :arg1 with the link :arg2
     */
    public function iPressTheArchiveButtonWithTheLink($arg1, $arg2) {
        $elements = $this->page->findAll('css', ".archive-article");
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getAttribute("data-article") == $arg2) {
                $elements[$i]->click();
                $found = true;
            }
            $i++;
        }

        $this->session->wait(2000, null);
    }

    /**
     * @When I click on the :arg1 link
     */
    public function iClickOnTheLink($arg1) {
        $el = $this->page->findLink($arg1);
        $el->click();
        $this->session->wait(2000, null);
    }

    /**
     * @Given I see the category button :arg1 with the link :arg2
     */
    public function iSeeTheCategoryButtonWithTheLink($arg1, $arg2) {
        $elements = $this->page->findAll('css', ".category-article");
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getAttribute("data-article") == $arg2) {
                $found = true;
            }
            $i++;
        }
    }

    /**
     * @When I press the category button :arg1 with the link :arg2
     */
    public function iPressTheCategoryButtonWithTheLink($arg1, $arg2) {
        $elements = $this->page->findAll('css', ".category-article");
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getAttribute("data-article") == $arg2) {
                $elements[$i]->click();
                $found = true;
            }
            $i++;
        }

        $this->session->wait(2000, null);
    }

    /**
     * @When I click the category :arg1 in the popup
     */
    public function iClickTheCategoryInThePopup($arg1) {
        $elements = $this->page->findAll('css', ".category-popup");
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getAttribute("data-category") == $arg1) {
                $elements[$i]->click();
                $found = true;
            }
            $i++;
        }

        $this->session->wait(2000, null);
    }

    /**
     * @When I click on the :arg1 category
     */
    public function iClickOnTheCategory($arg1) {
        $elements = $this->page->findAll('css', ".category");
        $found = false;
        $i = 0;
        while ($found == false && $i < count($elements)) {
            if ($elements[$i]->getAttribute("href") == "/category/" . $arg1) {
                $elements[$i]->click();
                $found = true;
            }
            $i++;
        }

        $this->session->wait(2000, null);
    }
}
