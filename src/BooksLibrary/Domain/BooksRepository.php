<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 10:21
 */

namespace BooksLibrary\Domain;


interface BooksRepository
{
    public function add(Book $book);

    public function find(string $isbn): ?Book;


}
