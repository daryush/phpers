<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 09:35
 */

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

use BooksLibrary\Application\Command\BorrowBook;
use BooksLibrary\Application\Handler\BorrowBookHandler;
use BooksLibrary\Domain\Book;
use BooksLibrary\Domain\BooksRepository;
use BooksLibrary\Domain\LibraryCard;
use BooksLibrary\Domain\LibraryCardsRepository;
use BooksLibrary\Infrastructure\Repository\BooksRepository\InMemoryBooksRepository;
use BooksLibrary\Infrastructure\Repository\LibraryCardsRepository\InMemoryLibraryCardsRepository;

class LibraryContext implements Context
{
    /** @var LibraryCardsRepository  */
    private $libraryCardsRepository;

    /** @var BooksRepository  */
    private $booksRepository;

    /** @var \DateTimeImmutable */
    private $today;

    public function __construct()
    {
        $this->libraryCardsRepository = new InMemoryLibraryCardsRepository();
        $this->booksRepository = new InMemoryBooksRepository();
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
     * @Given there is book :bookTitle with isbn number :isbn that can be borrowed for :borrowingDays days
     */
    public function thereIsBookWithIsbnNumberThatCanBeBorrowedForDays($bookTitle, $isbn, $borrowingDays)
    {
        $book = new Book($bookTitle, $isbn, $borrowingDays);
        $this->booksRepository->add($book);
    }

    /**
     * @Given today is :date
     */
    public function todayIs($date)
    {
        $this->today = new \DateTimeImmutable($date);
    }

    /**
     * @When :readerEmail borrow book marked with isbn :isbn
     */
    public function borrowBookMarkedWithIsbn($readerEmail, $isbn)
    {
        $command = new BorrowBook($readerEmail, $isbn);

        (new BorrowBookHandler($this->booksRepository, $this->libraryCardsRepository))->handle($command);
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
