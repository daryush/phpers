<?php

namespace BooksLibrary\Infrastructure\Repository\LibraryCardsRepository;

use BooksLibrary\Domain\LibraryCard;
use BooksLibrary\Domain\LibraryCardsRepository;


class InMemoryLibraryCardsRepository implements LibraryCardsRepository
{
    private $cards;

    public function add(LibraryCard $libraryCard)
    {
        $this->cards[$libraryCard->getReaderEmail()] = $libraryCard;
    }
}
