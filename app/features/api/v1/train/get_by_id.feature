Feature: Train resource GET feature

  Scenario: I can GET an existing resource
    When I send a GET request to "/api/v1/train/00000000-0000-0005-0000-000000000000"
    Then the response status code should be 200
    And the JSON should be equal to:
    """
    {
      "id": "00000000-0000-0005-0000-000000000000",
      "number": "S1 8856",
      "stations": [
        "00000000-0000-0004-0000-000000000000",
        "00000000-0000-0004-0000-000000000001",
        "00000000-0000-0004-0000-000000000002",
        "00000000-0000-0004-0000-000000000003"
      ]
    }
    """

  Scenario: When resource is not available, I will get gentle error message
    When I send a GET request to "/api/v1/train/00000000-0000-0005-0000-000000000099"
    Then the response status code should be 404
    And the JSON should be equal to:
    """
    {
      "code": 404,
      "message": "Train with given ID was not found."
    }
    """
