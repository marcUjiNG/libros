<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BooksRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/ws/books-before-year/{year}', name: 'books-before-year')]
    public function booksBeforeYear(BooksRepository $repo, string $year): JsonResponse
    {
        $books = [];
        foreach ($repo->findAllBeforeYear($year) as $book) {
            $books[] = $book->toArray();
        }
        return new JsonResponse([
            'books' => $books
        ]);
    }

    /*
        #[Route('/book', name: 'list_book', methods: ['GET'])]
        public function list(BooksRepository $repo): Response
        {
            return $this->render('book/list.html.twig', [
                'books' => $repo->findAll()
            ]);
        }
    */
    #[Route('/ws/book/{slug}', name: 'show_book', methods: ['GET'])]
    public function show(string $slug, BooksRepository $repo): JsonResponse
    {
        $bk = $repo->findOneBy(['isbn' => $slug]);

        return new JsonResponse($bk->toArray());

        /*
        return $this->render('book/show.html.twig', [
            'book' => $repo->findOneBy(
                ['isbn' => $slug]
            )
        ]);*/
    }

    /*
        #[Route('/book', name: 'book_list_c:', methods: ['GET'])]
        public function category(string $slug): Response
        {
            return $this->render('book/list.html.twig', [

            ]);
        }
*/

    public function loadFile(): Response
    {
        $localPackage = new UrlPackage(
            'file:///path/to/images/',
            new EmptyVersionStrategy()
        );



        return new Response($localPackage->getUrl('/logo.png'));
    }

    #[Route('ws/add-book', name: 'add-book:')]
    public function addBook(ManagerRegistry $doctrine, BooksRepository $repo, string $query): Response
    {
        $book = new Book();

        $book->setFromJson($query);

        $repo->save($book);

        return new Response();
    }
    /*
            #[Route('/book/{slug}', name: 'book_remove:', methods: ['DELETE'])]
            public function remove(string $slug): Response
            {
                return $this->render('book/list.html.twig', [

                ]);
            }*/


}