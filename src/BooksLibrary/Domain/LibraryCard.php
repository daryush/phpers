<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 10:14
 */

namespace BooksLibrary\Domain;


class LibraryCard
{
    /**
     * @var string
     */
    private $readerEmail;
    private $borrowings = [];

    public function __construct(string $readerEmail)
    {
        $this->readerEmail = $readerEmail;
    }

    /**
     * @return string
     */
    public function getReaderEmail(): string
    {
        return $this->readerEmail;
    }

    public function recordBorrowing(Book $book)
    {
        $this->borrowings[] = new BookBorrowing(
            $book->getIsbn(),
            new \DateTimeImmutable(),
            (new \DateTimeImmutable())->add(
                new \DateInterval(
                    sprintf('P%sD', $book->getBorrowingDays()
                    )
                )
            )
        );


    }

    /**
     * @return BookBorrowing[]
     */
    public function getBorowings(): array
    {
        return $this->borrowings;
    }
}
