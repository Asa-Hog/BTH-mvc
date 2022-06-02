<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Weather;
use App\Entity\City;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use App\Repository\WeatherRepository;
use App\Repository\CityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use App\Weather\Proj;

class ProjectController extends AbstractController
{
    // #[Route('/project', name: 'app_project')]
    // public function index(): Response
    // {
    //     return $this->render('project/index.html.twig', [
    //         'controller_name' => 'ProjectController',
    //     ]);
    // }
    #[Route('/', name: 'app_project')]
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
        CityRepository $cityRepository,
        ChartBuilderInterface $chartBuilder
    ): Response {
        // LÄS IN DATA FRÅN DATABASEN
        $weather = $weatherRepository
        ->findAll();

        $projChart = new Proj();
        $chartsTemp = $projChart->createChartTemperature($weather, $chartBuilder);
        $chartsPrec = $projChart->createChartsPrecipitation($weather, $chartBuilder);
        $chartsPrecDays = $projChart->createChartsPrecipitationDays($weather, $chartBuilder);
        $chartsDays1 = $projChart->createChartsDays1($weather, $chartBuilder);
        $chartsDays2 = $projChart->createChartsDays2($weather, $chartBuilder);
        $chartsDays3 = $projChart->createChartsDays3($weather, $chartBuilder);
        $chartsAverageTemp = $projChart->createAverageTemperature($weather);

        // $chartsDays = [$chartsDays1, $chartsDays2, $chartsDays3];

        $charts = [$chartsTemp, $chartsPrec, $chartsPrecDays, $chartsDays1, $chartsDays2, $chartsDays3, $chartsAverageTemp];
        // $charts = [$chartsTemp];
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

    /**
     * @Route("/proj/login", name="loginProj",
     * methods ={"GET"})
     */
    public function loginProj(
        SessionInterface $session,
        UserRepository $userRepository,
    ): Response {
        $type = $session->get("userType");

        // Om användare är doe
        if ($type == "doe") {
            echo "user is doe";
            // return $this->redirectToRoute('showUserByIdProj', {'id':$id});
            return $this->redirectToRoute('showUserByIdSessionProj');
        }

        // Om användare är admin
        if ($type == "admin") {
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
    ): Response {

         // GET FROM FORM
        $acronym = $request->request->get('acronym');
        $pwd = $request->request->get('pwd');

        // GET USERS FROM DATABASE
        $users = $userRepository
        ->findAll();

        // Gå igenom alla användare
        $noOfUsers = count($users);
        for ($i = 0; $i < $noOfUsers; $i++) {
            // Om matchning finns - användare finns med denna acronym och pwd
            if ($users[$i]->getAcronym() == $acronym && $users[$i]->getPwd() == $pwd) {
                $type = $users[$i]->getType();
                $id = $users[$i]->getId();

                // Spara användare i SESSIONEN
                $session->set("userType", $type);
                $session->set("userId", $id);

                // Om användare är doe
                if ($type == "doe") {
                    echo "user is doe";
                    // return $this->redirectToRoute('showUserByIdProj', {'id':$id});
                    return $this->redirectToRoute('showUserByIdSessionProj');
                }

                // Om användare är admin
                if ($type == "admin") {
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
     * @Route("/proj/reset", name="resetProj")
     */
    public function reset(
        ManagerRegistry $doctrine,
        SessionInterface $session,
        UserRepository $userRepository,
        WeatherRepository $weatherRepository,
        CityRepository $cityRepository
    ): Response {
        $session->clear();

        $entityManager = $doctrine->getManager();

        // Hämta alla användare
        $users = $userRepository
        ->findAll();

        // Radera alla användare från databasen
        $noOfUsers = count($users);
        for ($i = 0; $i < $noOfUsers; ++$i) {
            $entityManager->remove($users[$i]);
            $entityManager->flush();
        }

        // ------------------------------------------
        // Hämta all väderdata
        $weather = $weatherRepository
        ->findAll();

        // // Radera all väderdata från databasen
        $noOfWeatherTables = count($weather);
        for ($i = 0; $i < $noOfWeatherTables; ++$i) {
            $entityManager->remove($weather[$i]);
            $entityManager->flush();
        }

        // ------------------------------------------
        // Hämta all stadsdata
        $city = $cityRepository
        ->findAll();

        // Radera all väderdata från databasen
        $noOfCityTables = count($city);
        for ($i = 0; $i < $noOfCityTables; ++$i) {
            $entityManager->remove($city[$i]);
            $entityManager->flush();
        }

        // ------------------------------------------
        $proj = new Proj();

        // Skapa användare
        $proj->createUsers($entityManager);
        // Lägg in mätvärden för vädret i databasen
        $proj->readToDatabase($entityManager);

        return $this->redirectToRoute('proj');
    }
}
