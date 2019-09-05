<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 10:21
 */

namespace BooksLibrary\Domain;


interface LibraryCardsRepository
{
    public function add(LibraryCard $libraryCard);


}
