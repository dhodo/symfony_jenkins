Feature: Test Jenkins
  Test Jenkins
  @javascript
  Scenario: Test Jenkins
    Given I reset the database
    And I am on "/"
    And I should see "Welcome to" in the "#welcome h1 span" element
#    And I click on the link "section-client"

#    Then stop 50000 miliseconds
