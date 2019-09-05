<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 10:48
 */

namespace BooksLibrary\Domain;


class Book
{
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $isbn;
    /**
     * @var int
     */
    private $borrowingDays;

    public function __construct(string $title, string $isbn, int $borrowingDays)
    {
        $this->title = $title;
        $this->isbn = $isbn;
        $this->borrowingDays = $borrowingDays;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getIsbn(): string
    {
        return $this->isbn;
    }

    /**
     * @return int
     */
    public function getBorrowingDays(): int
    {
        return $this->borrowingDays;
    }



}
