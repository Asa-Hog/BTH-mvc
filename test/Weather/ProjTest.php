<?php

namespace App\Weather;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Entity\Weather;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\WeatherRepository;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use App\Weather\Proj;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Proj.
 */
class ProjTest extends TestCase
{

    // protected ChartBuilder $chartBuilder;

    public function __construct()
    {
        // $this->chartBuilder = $chartBuilder;
        // $this->chartBuilder = new Symfony\UX\Chartjs\Builder\ChartBuilder();
    }

    // /**
    //  * Tests that the method returns a chart
    //  */
    // public function testCreateChartTemperature()
    // {

    //     // $entityManager = $doctrine->getManager();
    //     // $chart = new Symfony\UX\Chartjs\Builder\ChartBuilderInterface();
    //     // $chart = $doctrine->getChart();
    //     // $chart = new Symfony\UX\Chartjs\Model\Chart();
    //     // echo $chart;

    //     $weather1 = new Weather();
    //     $weather1->setYears([2005]);
    //     $weather1->setTemperature([6.8]);
    //     $weather1->setPrecipitation([200]);
    //     $weather1->setCityId(1);
    //     $weather1->setFrost([105]);
    //     $weather1->setSummer([20]);

    //     $weather2 = new Weather();
    //     $weather2->setYears([2010]);
    //     $weather2->setTemperature([8.8]);
    //     $weather2->setPrecipitation([250]);
    //     $weather2->setCityId(2);
    //     $weather2->setFrost([100]);
    //     $weather2->setSummer([7]);

    //     $weather3 = new Weather();
    //     $weather3->setYears([2015]);
    //     $weather3->setTemperature([8.2]);
    //     $weather3->setPrecipitation([200]);
    //     $weather3->setCityId(3);
    //     $weather3->setFrost([150]);
    //     $weather3->setSummer([5]);

    //     $weather = [$weather1, $weather2, $weather3];

    //     $proj = new Proj();
    //     // $chartBuilder = new \App\ChartBuilderInterface();

    //     $res = $proj->createChartTemperature($weather, $this->$chartBuilder);

    //     // $this->assertNotInstanceOf($res, int);
    //     $this->assertInstanceOf($res, $this->chartBuilder);
    // }



//     /**
//      * Tests that the method returns an array
//      */
//     public function testCreateAverageTemperature()
//     {
//         $weather1 = new Weather();
//         $weather1->setYears([2005]);
//         $weather1->setTemperature([6.8]);
//         $weather1->setPrecipitation([200]);
//         $weather1->setCityId(1);
//         $weather1->setFrost([105]);
//         $weather1->setSummer([20]);

//         $weather2 = new Weather();
//         $weather2->setYears([2010]);
//         $weather2->setTemperature([8.8]);
//         $weather2->setPrecipitation([250]);
//         $weather2->setCityId(2);
//         $weather2->setFrost([100]);
//         $weather2->setSummer([7]);

//         $weather3 = new Weather();
//         $weather3->setYears([2015]);
//         $weather3->setTemperature([8.2]);
//         $weather3->setPrecipitation([200]);
//         $weather3->setCityId(3);
//         $weather3->setFrost([150]);
//         $weather3->setSummer([5]);

//         $weather = [$weather1, $weather2, $weather3];

//         $proj = new Proj();

//         $res = $proj->createAverageTemperature($weather);

//         $this->assertIsArray($res);
//     }

    // /**
    //  * Tests that the method returns an array
    //  */
    // public function testCreateUser()
    // {
    //     $proj = new Proj();

    //     $user = new User();
    //     $user->setEmail('test@test.com');
    //     $user->setImg('smiley-pixabay.png');
    //     $user->setAcronym('test');
    //     $user->setName('Test');
    //     $user->setPwd('Testson');
    //     $user->setType('doe');
    //     $entityManager->persist($user);
    //     $entityManager->flush();

    //     $proj->createUsers();
    //     // TA BORT ANVÄNDARE FRÅN DATABASEN


    //     //LÄS IN ANVÄNDARE

    //     $this->assertIsArray($res);
    //     $this->assertCount($res, 3);
    // }





    
}

// must be of type
// Symfony\UX\Chartjs\Model\Chart
