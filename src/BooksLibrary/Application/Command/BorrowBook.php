<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 11:07
 */

namespace BooksLibrary\Application\Command;


class BorrowBook
{
    /**
     * @var string
     */
    private $readerEmail;
    /**
     * @var string
     */
    private $isbn;

    /**
     * @var \DateTimeImmutable
     */
    private $borrowDate;

    public function __construct(string $readerEmail, string $isbn, \DateTimeImmutable $borrowDate)
    {
        $this->readerEmail = $readerEmail;
        $this->isbn = $isbn;
        $this->borrowDate = $borrowDate;
    }

    /**
     * @return string
     */
    public function getReaderEmail(): string
    {
        return $this->readerEmail;
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBorrowDate(): \DateTimeImmutable
    {
        return $this->borrowDate;
    }
}
