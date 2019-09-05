<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 13:23
 */

namespace BooksLibrary\Infrastructure\Repository\LibraryCardsRepository;


use BooksLibrary\Domain\LibraryCard;
use BooksLibrary\Domain\LibraryCardsRepository;
use Doctrine\Common\Persistence\ObjectManager;

class DoctrineLibraryCardsRepository implements LibraryCardsRepository
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function add(LibraryCard $libraryCard)
    {
        $this->objectManager->persist($libraryCard);
        $this->objectManager->flush();
    }

    public function find(string $email): ?LibraryCard
    {
        return $this->objectManager->getRepository(LibraryCard::class)->findOneBy(
            ['readerEmail' => $email]
        );
    }
}
