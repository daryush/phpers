<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 11:31
 */

namespace BooksLibrary\Domain;


class BookBorrowing
{
    /**
     * @var string
     */
    private $isbn;
    /**
     * @var \DateTimeImmutable
     */
    private $borrowingDate;
    /**
     * @var \DateTimeImmutable
     */
    private $returnDate;

    public function __construct(string $isbn, \DateTimeImmutable $borrowingDate, \DateTimeImmutable $returnDate)
    {
        $this->isbn = $isbn;
        $this->borrowingDate = $borrowingDate;
        $this->returnDate = $returnDate;
    }
}
