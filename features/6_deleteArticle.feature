Feature: Delete an article 

Scenario: Click on the cross to delete the corresponding article
    Given I am on the homepage
    And I see the delete button "delete-article" with the link "http://kotaku.com/ten-catchy-anime-theme-songs-from-winter-2016-1766283876"
    When I press the delete button "delete-article" with the link "http://kotaku.com/ten-catchy-anime-theme-songs-from-winter-2016-1766283876"
    Then I should not see the article "Ten Catchy Anime Theme Songs from Winter 2016"