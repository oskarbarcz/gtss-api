Feature: Login feature

  Scenario: I can login to application
    Given I set "Content-Type" header equal to "application/json"
    When I send a POST request to "/api/login_check" with body:
    """
    {
      "username": "test@test.com",
      "password": "password"
    }
    """
    Then the response status code should be 200
    And the JSON node "token" should exist
