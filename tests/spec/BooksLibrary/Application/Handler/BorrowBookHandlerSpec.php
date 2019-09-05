<?php

namespace spec\BooksLibrary\Application\Handler;

use BooksLibrary\Application\Command\BorrowBook;
use BooksLibrary\Application\Handler\BorrowBookHandler;
use BooksLibrary\Domain\Book;
use BooksLibrary\Domain\BooksRepository;
use BooksLibrary\Domain\LibraryCard;
use BooksLibrary\Domain\LibraryCardsRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BorrowBookHandlerSpec extends ObjectBehavior
{
    function it_borrow_book_for_reader(
        BooksRepository $booksRepository,
        Book $book,
        LibraryCardsRepository $libraryCardsRepository,
        LibraryCard $libraryCard
    ) {
        $this->beConstructedWith($booksRepository, $libraryCardsRepository);

        $readerEmail = 'john@test.com';
        $isbn = '9781234567897';
        $command = new BorrowBook(
            $readerEmail,
            $isbn
        );

        $booksRepository->find($isbn)->willReturn($book);
        $libraryCardsRepository->find($readerEmail)->willReturn($libraryCard);

        $libraryCard->recordBorrowing($book)->shouldBeCalled();

//        $libraryCard->getBorowings()->shouldHaveCount(0);

        $this->handle($command);

//        $libraryCard->getBorowings()->shouldHaveCount(1);

    }
}
