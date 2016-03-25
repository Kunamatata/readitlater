Feature: Change the category of an article

Scenario: Click on the archive icon to archive the corresponding article
   Given I am on the homepage
    And I see the category button "category-article" with the link "http://kotaku.com/ten-catchy-anime-theme-songs-from-winter-2016-1766283876"
    When I press the category button "category-article" with the link "http://kotaku.com/ten-catchy-anime-theme-songs-from-winter-2016-1766283876"
    And I click the category "PHP" in the popup
    And I click on the "PHP" category
    Then I see the title of the article "Ten Catchy Anime Theme Songs from Winter 2016"