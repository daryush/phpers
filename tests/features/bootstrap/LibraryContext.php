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
     * @Then :readerEmail library card should contain borrowing of book with isbn :isbn
     */
    public function libraryCardShouldContainBorrowingOfBookWithIsbn($readerEmail, $isbn)
    {
        /** @var LibraryCard $libraryCard */
        $libraryCard = $this->libraryCardsRepository->find($readerEmail);

        foreach ($libraryCard->getBorowings() as $borrowing) {
            if ($borrowing->getIsbn() === $isbn) {
                return;
            }
        }

        throw new \LogicException(sprintf('there is no borrowing of book %s', $isbn));
    }

    /**
     * @Then :readerEmail should return book with isbn :isbn at least on :returnDate
     */
    public function shouldReturnBookWithIsbnAtLeastOn($readerEmail, $isbn, $returnDate)
    {
        /** @var LibraryCard $libraryCard */
        $libraryCard = $this->libraryCardsRepository->find($readerEmail);

        foreach ($libraryCard->getBorowings() as $borrowing) {
            if ($borrowing->getIsbn() === $isbn) {
                if ($borrowing->getReturnDate()->format('d-m-Y') !== $returnDate) {
                    throw new \LogicException(
                        sprintf(
                            'return date should be %s not $s',
                            $borrowing->getReturnDate()->format('d-m-Y'),
                            $returnDate
                        )
                    );
                } else {
                    return;
                }
            }
        }

        throw new \LogicException(sprintf('there is no borrowing of book %s', $isbn));
    }
}
