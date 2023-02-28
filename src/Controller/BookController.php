<?php
namespace App\Controller;

use App\Entity\Book;
use App\Repository\BooksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Config\Framework\RequestConfig;

class BookController extends AbstractController
{
    #[Route('/book', name: 'list_book', methods: ['GET'])]
    public function list(BooksRepository $repo): Response
    {
        return $this->render('book/list.html.twig', [
            'books' => $repo->findAll()
        ]);
    }

    #[Route('/book/{slug}', name: 'show_book', methods: ['GET'])]
    public function show(string $slug, BooksRepository $repo): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $repo->findOneBy(
                ['isbn' => $slug]
            )
        ]);
    }

    #[Route('/book', name: 'book_list_y:', methods: ['GET'])]
    public function year(string $year, BooksRepository $repo): Response
    {
        return $this->render('book/list.html.twig', [
            'books' => $repo->findAllBefore2013(
                ['date' => $year]
            )
        ]);
    }

    #[Route('/book', name: 'book_list_c:', methods: ['GET'])]
    public function category(string $slug): Response
    {
        return $this->render('book/list.html.twig', [

        ]);
    }

    #[Route('/book', name: 'book_add:', methods: ['POST'])]
    public function new(Request $request): Response
    {
        $book = new Book();

        return $this->render('book/show.html.twig', [

        ]);
    }

    #[Route('/book/{slug}', name: 'book_remove:', methods: ['DELETE'])]
    public function remove(string $slug): Response
    {
        return $this->render('book/list.html.twig', [

        ]);
    }



}