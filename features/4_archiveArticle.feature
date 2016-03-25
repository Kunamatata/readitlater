Feature: Archive and then dearchive an article 

Scenario: Click on the archive icon to archive the corresponding article
    Given I am on the homepage
    And I see the archive button "archive-article" with the link "http://kotaku.com/ten-catchy-anime-theme-songs-from-winter-2016-1766283876"
    When I press the archive button "archive-article" with the link "http://kotaku.com/ten-catchy-anime-theme-songs-from-winter-2016-1766283876"
    And I click on the "get-archived" link
    Then I see the title of the article "Ten Catchy Anime Theme Songs from Winter 2016"

Scenario: Click on the archive icon to dearchive the corresponding article
    Given I am on the homepage
    And I click on the "get-archived" link
    And I see the archive button "archive-article" with the link "http://kotaku.com/ten-catchy-anime-theme-songs-from-winter-2016-1766283876"
    When I press the archive button "archive-article" with the link "http://kotaku.com/ten-catchy-anime-theme-songs-from-winter-2016-1766283876"
    And I click on the "get-archived" link
    Then I see the title of the article "Ten Catchy Anime Theme Songs from Winter 2016"