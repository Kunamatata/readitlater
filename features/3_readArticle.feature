Feature: Read an article 

Scenario: Click on "Read more" on an article to read its content
    Given I am on the homepage
    And I see the link named "Read more..."
    When I press the read more link "/read/Ten Catchy Anime Theme Songs from Winter 2016"
    Then I should see the page of the article "http://127.0.0.1:8000/read/Ten%20Catchy%20Anime%20Theme%20Songs%20from%20Winter%202016"