<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    /**
     * @Route("/book/create", name="book_create",
     * methods={"GET", "POST"})
     */
    public function showCreateForm(
    ): Response {
        return $this->render('book/create.html.twig');
    }

    /**
     * @Route("/book/create/save", name="book_create_save"),
     * methods={"GET", "POST"})
     */
    public function createBook(
        // ManagerRegistry $doctrine, Request $request
    ): Response {
        // $entityManager = $doctrine->getManager();

        // GET FROM FORM
        // $title = $request->query->get('title');
        // $isbn = $request->query->get('isbn');
        // $author = $request->query->get('author');
        // $image = $request->query->get('image');

        echo "hjej";
        // var_dump($title);

        // $book = new Book();
        // $book->setTitle($title);
        // $book->setIsbn($isbn);
        // $book->setAuthor($author);
        // $book->setImg($image);

        // $book->setName('Keyboard_num_' . rand(1, 9));
        // $book->setValue(rand(100, 999));

        // tell Doctrine you want to (eventually) save the Book
        // (no queries yet)
        // $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        // $entityManager->flush();

        // return new Response('Saved new book with id '.$book->getId());
        // return new Response('Saved new book' );
        return $this->redirectToRoute('book_show_all');
        // return $this->render('book/show.html.twig');
    }

        // $book = new Book();
        // $book->setTitle('Where the crawdads sing');
        // $book->setIsbn(9781472154668);
        // $book->setAuthor('Delia Owens');
        // $book->setImg('/public/image/where-the-crawdads-sing.jpg');
        // $entityManager->persist($book);

        // $book = new Book();
        // $book->setTitle('A thousand splendid suns');
        // $book->setIsbn(9780747585893);
        // $book->setAuthor('Khaled Hosseini');
        // $book->setImg('/public/image/a-thousand-splendid-suns.jpg');
        // $entityManager->persist($book);

        // $book = new Book();
        // $book->setTitle('Ljuset vi inte ser');
        // $book->setIsbn(9789187441769);
        // $book->setAuthor('Anthony Doerr');
        // $book->setImg('/public/image/ljuset-vi-inte-ser.jpg');
        // $entityManager->persist($book);

    /**
    * @Route("/book/show", name="book_show_all")
    */
    public function showAllBook(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        return $this->json($books);
    }


    /**
     * @Route("/book/show/{id}", name="book_by_id")
     */
    public function showBookById(
        BookRepository $bookRepository,
        int $id
    ): Response {
        $book = $bookRepository
            ->find($id);

        return $this->json($book);
    }


    /**
     * @Route("/book/delete/{id}", name="book_delete_by_id")
     */
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $entityManager->remove($book);
        $entityManager->flush();

        return $this->redirectToRoute('book_show_all');
    }

    /**
     * @Route("/book/update/{id}/{value}", name="book_update")
     */
    public function updateBook(
        ManagerRegistry $doctrine,
        int $id,
        int $value
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id '.$id
            );
        }

        $book->setValue($value);
        $entityManager->flush();

        return $this->redirectToRoute('book_show_all');
    }

}
