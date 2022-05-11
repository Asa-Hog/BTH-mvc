<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;



class ProjectController extends AbstractController
{
    /**
     * @Route("/proj", name="proj")
     */
    public function proj(): Response
    {
        return $this->render('proj.html.twig');
    }

    /**
     * @Route("/proj/about", name="aboutProj")
     */
    public function about(): Response
    {
        return $this->render('proj/about.html.twig');
    }

    /**
     * @Route("/proj/cleancode", name="cleancodeProj")
     */
    public function cleancode(): Response
    {
        return $this->render('proj/cleancode.html.twig');
    }

    //*///////////////////////////////////////////////////////

    /**
     * @Route("/proj/user/create", name="createUserProj",
     * methods={"GET"})
     */
    public function create(): Response
    {
        return $this->render('proj/create.html.twig');
    }

    /**
     * @Route("/proj/user/create", name="createUserSaveProj",
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
            // if ($_POST['password']) {
            // // $acronym = $request->request->get('acronym');
            // // $pwd = $request->request->get('pwd')
            // $pwd = $_POST["pwd"];
            // $hash = password_hash($pwd, PASSWORD_DEFAULT); 
            // $password_verify($pwd, $hash);
            //  }
        $email = $request->request->get('email');
        $img = $request->request->get('img');
        $acronym = $request->request->get('acronym');
        $name = $request->request->get('name');
        $pwd = $request->request->get('pwd');
        // Spara det hashade lösenordet i databasen
        // $pwdBeforeHashing = $request->request->get('pwd');
        // $pwd = password_hash($pwdBeforeHashing, PASSWORD_DEFAULT); 
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
        return $this->redirectToRoute('loginProj');
    }


    /**
     * @Route("/proj/login", name="loginProj",
     * methods ={"GET"})
     */
    public function loginProj(SessionInterface $session, 
        UserRepository $userRepository,): Response
    {
        $type = $session->get("userType");

        // Om användare är doe
        if ($type == "doe")
        {
            echo "user is doe";
            // return $this->redirectToRoute('showUserByIdProj', {'id':$id});
            return $this->redirectToRoute('showUserByIdSessionProj');
        }

        // Om användare är admin
        if ($type == "admin")
        {
            $users = $userRepository
            ->findAll();
            $data = [
            'users' => $users
            ];
            return $this->redirectToRoute('showAllUsersProj', $data);
        }


        return $this->render('proj/login.html.twig');
    }

    /**
     * @Route("/proj/login", name="loginProcessProj",
     * methods={"POST"})
     */
    public function userProj(
        UserRepository $userRepository,
        Request $request,
        SessionInterface $session
    ): Response
    {

         // GET FROM FORM
        //  if ($_POST['pwd']) {
        $acronym = $request->request->get('acronym');
        $pwd = $request->request->get('pwd');
            // $pwd = $_POST["pwd"];
            // $hash = password_hash($pwd, PASSWORD_DEFAULT); 
            // $password_verify($pwd, $hash);
        //  }

        // GET USERS FROM DATABASE
        $users = $userRepository
        ->findAll();

        // Gå igenom alla användare
        for ($i = 0; $i < count($users); $i++)  {
            // Om matchning finns - användare finns med denna acronym och pwd
            if ($users[$i]->getAcronym() == $acronym && $users[$i]->getPwd()==$pwd) {
                $type = $users[$i]->getType();
                $id = $users[$i]->getId();

                // Spara användare i SESSIONEN
                $session->set("userType", $type);
                $session->set("userId", $id);

                // Om användare är doe
                if ($type == "doe")
                {
                    echo "user is doe";
                    // return $this->redirectToRoute('showUserByIdProj', {'id':$id});
                    return $this->redirectToRoute('showUserByIdSessionProj');
                }

                // Om användare är admin
                if ($type == "admin")
                {
                    $users = $userRepository
                    ->findAll();
                    $data = [
                    'users' => $users
                    ];
                    return $this->redirectToRoute('showAllUsersProj', $data);
                }
            }
        }
        // Hämta inloggad användare från sessionen
        // $user = $session->get("user") ?? new User($acronym, $pwd);
    // Om matchning inte finns - stanna kvar på samma sida
    echo "No match";
    return $this->redirectToRoute('loginProj');


    }

    /**
     * @Route("/proj/logout", name="logoutProj",
     * methods={"GET"})
     */
    public function logout(): Response
    {
        return $this->render('proj/logout.html.twig');
    }

    /**
     * @Route("/proj/logout", name="logoutProcessProj",
     * methods={"POST"})
     */
    public function logoutProcess(SessionInterface $session): Response
    {
        $session->clear();
        return $this->redirectToRoute('loginProj');
    }


    /**
     * @Route("/proj/show/{id}", name="showUserByIdProj")
     */
    public function showUserById(
        UserRepository $userRepository,
        SessionInterface $session,
        int $id
    ): Response {
        $type = $session->get("userType") ?? null ;
        $user = $userRepository
            ->find($id);

        $data = [
            'user' => $user,
            'type' => $type
            ];

        return $this->render('proj/show-one.html.twig', $data);
    }

    /**
     * @Route("/proj/show", name="showUserByIdSessionProj")
     */
    public function showUserByIdSession(
        UserRepository $userRepository,
        SessionInterface $session
    ): Response {
        $type = $session->get("userType") ?? null ;
        $id = $session->get("userId");

        $user = $userRepository
            ->find($id);

        $data = [
            'user' => $user,
            'type' => $type
            ];

        return $this->render('proj/show-one.html.twig', $data);
    }


    /**
    * @Route("/proj/user/show", name="showAllUsersProj")
    */
    public function showAllUsers(
        UserRepository $userRepository,
        SessionInterface $session
    ): Response {
        $type = $session->get("userType");

        // Om användare är doe
        if ($type == "doe")
        {
            return $this->redirectToRoute('showUserByIdSessionProj');
        }

        // Om användare är admin
        if ($type == "admin") {
            $users = $userRepository
            ->findAll();
            $data = [
            'users' => $users
            ];

            return $this->render('proj/show.html.twig', $data);
        }
    }

    /**
     * @Route("/proj/delete/{id}", name="deleteUserByIdProj",
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

        return $this->render('proj/delete.html.twig', $data);
    }

    /**
     * @Route("/proj/delete/{id}", name="deleteUserByIdProcess",
     * methods={"POST"})
     */
    public function deleteUserByIdProcess(
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

        $entityManager->remove($user);
        $entityManager->flush();

        return $this->redirectToRoute('showAllUsersProj');
    }


    /**
     * @Route("/proj/update/{id}", name="updateUserByIdProj",
     * methods={"GET"})
     */
    public function updateUser(
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

        $data = [
            'user' => $user
            ];

        return $this->render('proj/update.html.twig', $data);
    }

    /**
     * @Route("/proj/update/{id}", name="updateUserProcessProj",
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
        // $user->setValue($value); // OBS Utför ändringarna här
        $entityManager->flush();

        return $this->redirectToRoute('showAllUsersProj');
    }

}
