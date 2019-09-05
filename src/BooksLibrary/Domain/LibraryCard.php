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
}
