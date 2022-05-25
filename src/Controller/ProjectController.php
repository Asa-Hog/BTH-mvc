<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Entity\Weather;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use App\Repository\WeatherRepository;
use Symfony\Component\HttpFoundation\Request;

use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

use App\Weather\Proj;

class ProjectController extends AbstractController
{
    #[Route('/project', name: 'app_project')]
    public function index(): Response
    {
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
        ]);
    }

    /**
     * @Route("/proj", name="proj")
     */
    public function proj(
        WeatherRepository $weatherRepository,
        ChartBuilderInterface $chartBuilder
    ): Response
    {
        // LÄS IN DATA FRÅN DATABASEN
        $weather = $weatherRepository
        ->findAll();

        $ProjChart = new Proj();
        $charts = $ProjChart->createCharts($weather, $chartBuilder);

        return $this->render('proj.html.twig', [
            'chart' => $charts
        ]);

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
    public function create(
        SessionInterface $session
    ): Response
    {
        $type = $session->get("userType") ?? null ;

        $data = [
            'type' => $type
            ];

        return $this->render('proj/create.html.twig', $data);
    }

    /**
     * @Route("/proj/user/create", name="createUserSaveProj",
     * methods={"POST"})
     */
    public function createUser(
        ManagerRegistry $doctrine,
        Request $request,
    ): Response {
        $entityManager = $doctrine->getManager();

        // GET FROM FORM
            // if ($_POST['password']) {
            // // $acronym = $request->request->get('acronym');
            // // $pwd = $request->request->get('pwd')
            // $pwd = $_POST["pwd"];
            //  }
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
        $acronym = $request->request->get('acronym');
        $pwd = $request->request->get('pwd');

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
        SessionInterface $session,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id ' . $id
            );
        }

        $type = $session->get("userType");

        $data = [
            'user' => $user,
            'type' => $type
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

    /**
     * @Route("/proj/reset", name="resetProj")
     */
    public function reset(
        ManagerRegistry $doctrine,
        SessionInterface $session,
        UserRepository $userRepository,
        WeatherRepository $weatherRepository
    ): Response {
        $session->clear();

        $entityManager = $doctrine->getManager();

        // Hämta alla användare
        $users = $userRepository
        ->findAll();

        // Radera alla användare från databasen
        for ($i = 0; $i < count($users); ++$i) {
            $entityManager->remove($users[$i]);
            $entityManager->flush();
        }

        // ------------------------------------------
        // Hämta all väderdata
        $weather = $weatherRepository
        ->findAll();

        // Radera all väderdata från databasen
        for ($i = 0; $i < count($weather); ++$i) {
            $entityManager->remove($weather[$i]);
            $entityManager->flush();
        }

        // ------------------------------------------
        $Proj = new Proj();

        // Skapa användare
        $Proj->createUsers($entityManager);
        // Lägg in mätvärden för vädret i databasen
        $Proj->readToDatabase($entityManager);

        return $this->redirectToRoute('proj');
    }
}
