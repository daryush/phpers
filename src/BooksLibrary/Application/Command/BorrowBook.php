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

    public function __construct(string $readerEmail, string $isbn)
    {
        $this->readerEmail = $readerEmail;
        $this->isbn = $isbn;
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
}
