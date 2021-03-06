Feature: Book borrowing
  In order to read book that I am interested in
  As a reader
  I need to be able to borrow book from library

  Scenario: Book borrowing
    Given there is reader "john@test.com"
    And there is book "Professional REST API" with isbn number "9781234567897" that can be borrowed for "20" days
    And today is "05-09-2019"
    When "john@test.com" borrow book marked with isbn "9781234567897"
    Then "john@test.com" library card should contain borrowing of book with isbn "9781234567897"
    And "john@test.com" should return book with isbn "9781234567897" at least on "25-09-2019"
