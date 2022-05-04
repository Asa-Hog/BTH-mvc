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
    /**
     * @Route("/book/create", name="book_create",
     * methods={"GET"})
     */
    public function showCreateForm(): Response
    {
        return $this->render('book/create.html.twig');
    }

    /**
     * @Route("/book/create", name="book_create_save"),
     * methods={"POST"})
     */
    public function createBook(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $entityManager = $doctrine->getManager();

        // $book = new Book();
        // $book->setTitle('Where the crawdads sing');
        // $book->setIsbn(9781472154668);
        // $book->setAuthor('Delia Owens');
        // $book->setImage('where-the-crawdads-sing.jpg');
        // $entityManager->persist($book);

        // $book = new Book();
        // $book->setTitle('A thousand splendid suns');
        // $book->setIsbn(9780747585893);
        // $book->setAuthor('Khaled Hosseini');
        // $book->setImage('a-thousand-splendid-suns.jpg');
        // $entityManager->persist($book);

        // $book = new Book();
        // $book->setTitle('Ljuset vi inte ser');
        // $book->setIsbn(9789187441769);
        // $book->setAuthor('Anthony Doerr');
        // $book->setImage('ljuset-vi-inte-ser.jpg');
        // $entityManager->persist($book);

        // GET FROM FORM
        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $image = $request->request->get('image');

        $book = new Book();
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($image);
        // $book->setName('Keyboard_num_' . rand(1, 9));
        // $book->setValue(rand(100, 999));

        // tell Doctrine you want to (eventually) save the Book
        // (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        // return new Response('Saved new book with id '.$book->getId());
        // return new Response('Saved new book' );
        return $this->redirectToRoute('book_show_all');
        // return $this->render('book/show.html.twig');
    }

    /**
    * @Route("/book/show", name="book_show_all")
    */
    public function showAllBook(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();
        $data = [
            'books' => $books
            ];

        return $this->render('book/show.html.twig', $data);
        // return $this->json($books);
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

        $data = [
            'book' => $book
            ];

        return $this->render('book/show-one.html.twig', $data);
    }


    /**
     * @Route("/book/delete/{id}", name="book_delete_by_id",
     * methods={"GET"})
     */
    public function deleteBookById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id ' . $id
            );
        }

        $data = [
            'book' => $book
            ];

        return $this->render('book/delete.html.twig', $data);
    }

    /**
     * @Route("/book/delete/{id}", name="book_delete_by_id_process",
     * methods={"POST"})
     */
    public function deleteBookByIdProcess(
        ManagerRegistry $doctrine,
        Request $request,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id ' . $id
            );
        }

        $entityManager->remove($book); // OBS Utför raderingen här
        $entityManager->flush();

        return $this->redirectToRoute('book_show_all');
    }


    /**
     * @Route("/book/update/{id}", name="book_update",
     * methods={"GET"})
     */
    public function updateBook(
        ManagerRegistry $doctrine,
        Request $request,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id ' . $id
            );
        }

        $data = [
            'book' => $book
            ];

        return $this->render('book/update.html.twig', $data);
    }

    /**
     * @Route("/book/update/{id}", name="book_update_process",
     * methods={"POST"})
     */
    public function updateBookProcess(
        ManagerRegistry $doctrine,
        Request $request,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $book = $entityManager->getRepository(Book::class)->find($id);

        if (!$book) {
            throw $this->createNotFoundException(
                'No book found for id ' . $id
            );
        }

        // GET FROM FORM
        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $image = $request->request->get('image');

        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($image);
        // $book->setValue($value); // OBS Utför ändringarna här
        $entityManager->flush();

        return $this->redirectToRoute('book_show_all');
    }
}
