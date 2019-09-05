<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 09:35
 */

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

use BooksLibrary\Domain\LibraryCard;
use BooksLibrary\Domain\LibraryCardsRepository;
use BooksLibrary\Infrastructure\Repository\LibraryCardsRepository\InMemoryLibraryCardsRepository;

class LibraryContext implements Context
{
    private $libraryCardsRepository;

    public function __construct()
    {
        $this->libraryCardsRepository = new InMemoryLibraryCardsRepository();
    }

    /**
     * @Given there is reader :readerEmail
     */
    public function thereIsReader($readerEmail)
    {
        $libraryCard = new LibraryCard($readerEmail);

        $this->libraryCardsRepository->add($libraryCard);
    }

    /**
     * @Given there is book :arg1 with isbn number :arg2 that can be borrowed for :arg3 days
     */
    public function thereIsBookWithIsbnNumberThatCanBeBorrowedForDays($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }

    /**
     * @Given today is :arg1
     */
    public function todayIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When :arg1 borrow book marked with isbn :arg2
     */
    public function borrowBookMarkedWithIsbn($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then :arg1 library card should contain borrowing of book with isbn :arg2
     */
    public function libraryCardShouldContainBorrowingOfBookWithIsbn($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then :arg1 should return book with isbn :arg2 at least on :arg3
     */
    public function shouldReturnBookWithIsbnAtLeastOn($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }
}
