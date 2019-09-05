#Feature: Book borrowing prolongation
#  In order to don't have to return book on specific date
#  As a reader
#  I need to be able to prolongate my borrowing period for book
#
#  Scenario: Borrowing prolongation
#    Given there is reader "john@test.com"
#    And there is borrowing of book with isbn "9781234567897" by reader "john@test.com" with return date "06-09-2019"
#    And prolongation period for book with isbn "9781234567897" is "3" days
#    When "john@test.com" prolongate borrowing of book "9781234567897"
#    Then return date of book "9781234567897" borrowed by "john@test.com" should be "09-09-2019"
