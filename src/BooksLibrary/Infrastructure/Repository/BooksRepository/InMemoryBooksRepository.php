<?php

namespace BooksLibrary\Infrastructure\Repository\BooksRepository;

use BooksLibrary\Domain\Book;
use BooksLibrary\Domain\BooksRepository;
use BooksLibrary\Domain\LibraryCard;
use BooksLibrary\Domain\LibraryCardsRepository;


class InMemoryBooksRepository implements BooksRepository
{
    private $books = [];

    public function add(Book $book)
    {
        $this->books[$book->getIsbn()] = $book;
    }

    public function find(string $isbn): ?Book
    {
        return array_key_exists($isbn, $this->books) ? $this->books[$isbn] : null;
    }
}
