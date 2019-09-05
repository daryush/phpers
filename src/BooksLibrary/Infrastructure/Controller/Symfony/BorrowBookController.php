<?php
/**
 * Created by PhpStorm.
 * User: daryush
 * Date: 2019-09-05
 * Time: 12:41
 */

namespace BooksLibrary\Infrastructure\Controller\Symfony;


use BooksLibrary\Application\Command\BorrowBook;
use BooksLibrary\Application\Handler\BorrowBookHandler;
use BooksLibrary\Domain\Book;
use BooksLibrary\Domain\BooksRepository;
use BooksLibrary\Domain\LibraryCard;
use BooksLibrary\Domain\LibraryCardsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Annotation\Route;

class BorrowBookController extends AbstractController
{
    /**
     * @Route("/library/borrow", name="library_borrow", methods={"POST"})
     */
    public function borrow(
        Request $request,
        BorrowBookHandler $handler,
        ValidatorInterface $validator,
        ObjectManager $objectManager
    ) {

        $command = new BorrowBook(
            $request->get('readerEmail'),
            $request->get('isbn')
        );

        $errors = $validator->validate($command);

        if (count($errors) === 0) {
            $handler->handle($command);

            $objectManager->flush();
            return $this->json(['status' => 'ok'], Response::HTTP_CREATED);
        }

        return $this->json($errors, Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/library/init", name="library_books_add", methods={"POST"})
     */
    public function add(
        Request $request,
        BooksRepository $booksRepository,
        LibraryCardsRepository $libraryCardsRepository
    ) {
        $booksRepository->add(new Book('Test', '9781234567897', 30));
        $booksRepository->add(new Book('Test 2', '9781234567898', 15));

        $libraryCardsRepository->add(new LibraryCard('john@test.com'));

        return $this->json(['status' => 'ok'], Response::HTTP_CREATED);
    }

    /**
     * @Route("/library/list", name="library_books_list", methods={"GET"})
     */
    public function list(
        Request $request,
        LibraryCardsRepository $cardsRepository
    ) {
        $card = $cardsRepository->find('john@test.com');


        return $this->json(['card' => $card], Response::HTTP_CREATED);
    }
}
