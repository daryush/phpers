<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 13:19
 */

namespace BooksLibrary\Infrastructure\Repository\BooksRepository;


use BooksLibrary\Domain\Book;
use BooksLibrary\Domain\BooksRepository;
use Doctrine\Common\Persistence\ObjectManager;

class DoctrineBooksRepository implements BooksRepository
{

    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function add(Book $book)
    {
        $this->objectManager->persist($book);
        $this->objectManager->flush();
    }

    public function find(string $isbn): ?Book
    {
        return $this->objectManager->getRepository(Book::class)->findOneBy(
            ['isbn' => $isbn]
        );
    }
}
