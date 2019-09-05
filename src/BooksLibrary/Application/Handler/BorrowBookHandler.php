<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 11:08
 */

namespace BooksLibrary\Application\Handler;


use BooksLibrary\Application\Command\BorrowBook;
use BooksLibrary\Domain\BooksRepository;
use BooksLibrary\Domain\LibraryCardsRepository;

class BorrowBookHandler
{
    /**
     * @var BooksRepository
     */
    private $booksRepository;
    /**
     * @var LibraryCardsRepository
     */
    private $libraryCardsRepository;

    public function __construct(BooksRepository $booksRepository, LibraryCardsRepository $libraryCardsRepository)
    {
        $this->booksRepository = $booksRepository;
        $this->libraryCardsRepository = $libraryCardsRepository;
    }

    public function handle(BorrowBook $command)
    {
        $book = $this->booksRepository->find($command->getIsbn());
        $libraryCard = $this->libraryCardsRepository->find($command->getReaderEmail());

        $libraryCard->recordBorrowing($book);
    }
}
