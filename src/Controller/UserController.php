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
    public function showCreateForm(): Response
    {
        return $this->render('user/create.html.twig');
    }

    /**
     * @Route("/user/create", name="user_create_save",
     * methods={"POST"})
     */
    public function createUser(
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $entityManager = $doctrine->getManager();

        // $user = new User();
        // $user->setEmail('doe@doe.com');
        // $user->setImg('smiley-pixabay.png');
        // $user->setAcronym('doe');
        // $user->setName('doe');
        // $user->setPwd('doe');
        // $user->setType('doe');
        // $entityManager->persist($user);

        // $user = new User();
        // $user->setEmail('admin@admin.com');
        // $user->setImg('smiley-pixabay.png');
        // $user->setAcronym('admin');
        // $user->setName('admin');
        // $user->setPwd('admin');
        // $user->setType('admin');
        // $entityManager->persist($user);

        // GET FROM FORM
        $email = $request->request->get('email');
        $img = $request->request->get('img');
        $acronym = $request->request->get('acronym');
        $name = $request->request->get('name');
        $pwd = $request->request->get('pwd');
        $type = $request->request->get('type');

        $user = new User();
        $user->setEmail($email);
        $user->setImg($img);
        $user->setAcronym($acronym);
        $user->setName($name);
        $user->setPwd($pwd);
        $user->setType($type);

        $entityManager->persist($user);

        $entityManager->flush();

        return $this->redirectToRoute('user_show_all');
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
                'No user found for id ' . $id
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
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id ' . $id
            );
        }

        $entityManager->remove($user); // OBS Utf??r raderingen h??r
        $entityManager->flush();

        return $this->redirectToRoute('user_show_all');
    }


    /**
     * @Route("/user/update/{id}", name="user_update",
     * methods={"GET"})
     */
    public function updateUser(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id ' . $id
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
        ManagerRegistry $doctrine,
        Request $request,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id ' . $id
            );
        }

        // GET FROM FORM
        $email = $request->request->get('email');
        $img = $request->request->get('img');
        $acronym = $request->request->get('acronym');
        $name = $request->request->get('name');
        $pwd = $request->request->get('pwd');
        $type = $request->request->get('type');

        $user->setEmail($email);
        $user->setImg($img);
        $user->setAcronym($acronym);
        $user->setName($name);
        $user->setPwd($pwd);
        $user->setType($type);
        // $user->setValue($value); // OBS Utf??r ??ndringarna h??r
        $entityManager->flush();

        return $this->redirectToRoute('user_show_all');
    }
}
