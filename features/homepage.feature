Feature: Show homepage

Scenario: Access to homepage and I should see `Read It Later` title
    Given I am on the homepage
    Then I should see "Read It Later"