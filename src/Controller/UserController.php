<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    /**
     * @Route("/user/create", name="user_create",
     * methods={"GET"})
     */
    public function showCreateForm(
    ): Response {
        return $this->render('user/create.html.twig');
    }

    /**
     * @Route("/user/create", name="user_create_save"),
     * methods={"POST"})
     */
    public function createUser(
        ManagerRegistry $doctrine, Request $request
    ): Response {
        $entityManager = $doctrine->getManager();

        // $user = new User();
        // $user->setTitle('Where the crawdads sing');
        // $user->setIsbn(9781472154668);
        // $user->setAuthor('Delia Owens');
        // $user->setImage('where-the-crawdads-sing.jpg');
        // $entityManager->persist($user);

        // $user = new User();
        // $user->setTitle('A thousand splendid suns');
        // $user->setIsbn(9780747585893);
        // $user->setAuthor('Khaled Hosseini');
        // $user->setImage('a-thousand-splendid-suns.jpg');
        // $entityManager->persist($user);


        // GET FROM FORM
        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $image = $request->request->get('image');

        $user = new User();
        $user->setTitle($title);
        $user->setIsbn($isbn);
        $user->setAuthor($author);
        $user->setImage($image);
        // $user->setName('Keyboard_num_' . rand(1, 9));
        // $user->setValue(rand(100, 999));

        // tell Doctrine you want to (eventually) save the User
        // (no queries yet)
        $entityManager->persist($user);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        // return new Response('Saved new user with id '.$user->getId());
        // return new Response('Saved new user' );
        return $this->redirectToRoute('user_show_all');
        // return $this->render('user/show.html.twig');
    }

    /**
    * @Route("/user/show", name="user_show_all")
    */
    public function showAllUser(
        UserRepository $userRepository
    ): Response {
        $users = $userRepository
            ->findAll();
        $data = [
            'users' => $users
            ];

        return $this->render('user/show.html.twig', $data);
        // return $this->json($users);
    }


    /**
     * @Route("/user/show/{id}", name="user_by_id")
     */
    public function showUserById(
        UserRepository $userRepository,
        int $id
    ): Response {
        $user = $userRepository
            ->find($id);

        $data = [
            'user' => $user
            ];

        return $this->render('user/show-one.html.twig', $data);
    }


    /**
     * @Route("/user/delete/{id}", name="user_delete_by_id",
     * methods={"GET"})
     */
    public function deleteUserById(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $data = [
            'user' => $user
            ];

        return $this->render('user/delete.html.twig', $data);
    }

    /**
     * @Route("/user/delete/{id}", name="user_delete_by_id_process",
     * methods={"POST"})
     */
    public function deleteUserByIdProcess(
        ManagerRegistry $doctrine, Request $request,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $entityManager->remove($user); // OBS Utför raderingen här
        $entityManager->flush();

        return $this->redirectToRoute('user_show_all');
    }


    /**
     * @Route("/user/update/{id}", name="user_update",
     * methods={"GET"})
     */
    public function updateUser(
        ManagerRegistry $doctrine, Request $request,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $data = [
            'user' => $user
            ];

        return $this->render('user/update.html.twig', $data);
    }

    /**
     * @Route("/user/update/{id}", name="user_update_process",
     * methods={"POST"})
     */
    public function updateUserProcess(
        ManagerRegistry $doctrine, Request $request,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        // GET FROM FORM
        $title = $request->request->get('title');
        $isbn = $request->request->get('isbn');
        $author = $request->request->get('author');
        $image = $request->request->get('image');

        $user->setTitle($title);
        $user->setIsbn($isbn);
        $user->setAuthor($author);
        $user->setImage($image);
        // $user->setValue($value); // OBS Utför ändringarna här
        $entityManager->flush();

        return $this->redirectToRoute('user_show_all');
    }

}
