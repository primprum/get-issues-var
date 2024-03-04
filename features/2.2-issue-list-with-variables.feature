Feature: Get a list of issues with variables

  Scenario: I want to get a list of the issues for the Symfony repository
    Given I am an anonymous user
    When I request a list of issues from user "primprum" for the repository "get-issues"
    Then I should get at least 1 result
