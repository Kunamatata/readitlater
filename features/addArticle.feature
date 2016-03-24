Feature: Add an article to the json file

Scenario: Access to homepage and click the add link button in the menu. The form must open and the user can 
add a link and press Save
    Given I am on the homepage
    And I see the menu link "Add Link"
    When I press the menu link "Add Link"
    And I fill in "Article Url" with "http://kotaku.com/ten-catchy-anime-theme-songs-from-winter-2016-1766283876"
    And I press the form button "Save Article"
    Then I see the title of the article "Ten Catchy Anime Theme Songs from Winter 2016"