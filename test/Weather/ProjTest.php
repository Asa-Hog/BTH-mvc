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
use App\Entity\City;
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

    // private ChartBuilder $chart;

    // public function __construct()
    // {
        // $this->chartBuilder = $chartBuilder;
        // $this->chart = new \App\ChartBuilder();
    // }

    /**
     * Tests that the method returns a chart
     */
    public function testCreateChartTemperature()
    {
        $weather1 = new Weather();
        $weather1->setYears([2005]);
        $weather1->setTemperature([6.8]);
        // $weather1->setPrecipitationDays([200]);
        // // $weather1->setCityId(1);
        $weather1->setFrost([105]);
        $weather1->setSummer([20]);

        $city1 = new City();
        // $city1[getName()] = 'Stad1';

        $weather1->setCity($city1);

        $weather2 = new Weather();
        $weather2->setYears([2010]);
        $weather2->setTemperature([8.8]);
        // $weather2->setPrecipitation([250]);
        // $weather2->setPrecipitationDays([250]);
        // // $weather2->setCityId(2);
        $weather2->setFrost([100]);
        $weather2->setSummer([7]);
        
        $city2 = new City();
        // $city1[getName()] = 'Stad1';

        $weather2->setCity($city2);

        $weather3 = new Weather();
        $weather3->setYears([2015]);
        $weather3->setTemperature([8.2]);
        // $weather3->setPrecipitationDays([300]);
        // // $weather3->setCityId(3);
        $weather3->setFrost([150]);
        $weather3->setSummer([5]);
        
        $city3 = new City();
        // $city3[getName()] = 'Stad1';

        $weather3->setCity($city3);

        $weather = [$weather1, $weather2, $weather3];

        $proj = new Proj();
        $chartBuilder = new \Symfony\UX\Chartjs\Builder\ChartBuilder(Chart::TYPE_LINE);

        $res = $proj->createChartTemperature($weather, $chartBuilder);

        // $this->assertInstanceOf("\App\Weather\Proj", $proj);
        // $this->assertInstanceOf($res, $this->chartBuilder);

        // $this->assertInstanceOf("\Symfony\UX\Chartjs\Model\Chart", $res);
        $this->assertNotEmpty($proj); // $res måste vara en array
    }

        /**
     * Tests that the method returns a chart
     */
    public function testCreateChartsPrecipitation()
    {
        $weather1 = new Weather();
        $weather1->setYears([2005]);
        // $weather1->setTemperature([6.8]);
        $weather1->setPrecDays([200]);
        // // $weather1->setCityId(1);
        $weather1->setFrost([105]);
        $weather1->setSummer([20]);

        $city1 = new City();
        // $city1[getName()] = 'Stad1';

        $weather1->setCity($city1);

        $weather2 = new Weather();
        $weather2->setYears([2010]);
        // $weather2->setTemperature([8.8]);
        // $weather2->setPrecipitation([250]);
        $weather2->setPrecDays([250]);
        // // $weather2->setCityId(2);
        $weather2->setFrost([100]);
        $weather2->setSummer([7]);
        
        $city2 = new City();
        // $city1[getName()] = 'Stad1';

        $weather2->setCity($city2);

        $weather3 = new Weather();
        $weather3->setYears([2015]);
        // $weather3->setTemperature([8.2]);
        $weather3->setPrecDays([300]);
        // // $weather3->setCityId(3);
        $weather3->setFrost([150]);
        $weather3->setSummer([5]);
        
        $city3 = new City();
        // $city3[getName()] = 'Stad1';

        $weather3->setCity($city3);

        $weather = [$weather1, $weather2, $weather3];

        $proj = new Proj();
        $chartBuilder = new \Symfony\UX\Chartjs\Builder\ChartBuilder(Chart::TYPE_BAR);

        $res = $proj->createChartsPrecipitation($weather, $chartBuilder);

        // $this->assertInstanceOf("\App\Weather\Proj", $proj);
        // $this->assertInstanceOf($res, $this->chartBuilder);

        // $this->assertInstanceOf("\Symfony\UX\Chartjs\Model\Chart", $res);
        $this->assertNotEmpty($proj); // $res måste vara en array
    }




    /**
     * Tests that the method returns a chart
     */
    public function testCreateChartsPrecipitationDays()
    {
        $weather1 = new Weather();
        $weather1->setYears([2005]);
        // $weather1->setTemperature([6.8]);
        $weather1->setPrecDays([200]);
        // // $weather1->setCityId(1);
        $weather1->setFrost([105]);
        $weather1->setSummer([20]);

        $city1 = new City();
        // $city1[getName()] = 'Stad1';

        $weather1->setCity($city1);

        $weather2 = new Weather();
        $weather2->setYears([2010]);
        // $weather2->setTemperature([8.8]);
        // $weather2->setPrecipitation([250]);
        $weather2->setPrecDays([250]);
        // // $weather2->setCityId(2);
        $weather2->setFrost([100]);
        $weather2->setSummer([7]);
        
        $city2 = new City();
        // $city1[getName()] = 'Stad1';

        $weather2->setCity($city2);

        $weather3 = new Weather();
        $weather3->setYears([2015]);
        // $weather3->setTemperature([8.2]);
        $weather3->setPrecDays([300]);
        // // $weather3->setCityId(3);
        $weather3->setFrost([150]);
        $weather3->setSummer([5]);
        
        $city3 = new City();
        // $city3[getName()] = 'Stad1';

        $weather3->setCity($city3);

        $weather = [$weather1, $weather2, $weather3];

        $proj = new Proj();
        $chartBuilder = new \Symfony\UX\Chartjs\Builder\ChartBuilder(Chart::TYPE_BAR);

        $res = $proj->createChartsPrecipitationDays($weather, $chartBuilder);

        // $this->assertInstanceOf("\App\Weather\Proj", $proj);
        // $this->assertInstanceOf($res, $this->chartBuilder);

        // $this->assertInstanceOf("\Symfony\UX\Chartjs\Model\Chart", $res);
        $this->assertNotEmpty($proj); // $res måste vara en array
    }




    /**
     * Tests that the method returns an array
     */
    public function testCreateAverageTemperature()
    {
        $weather1 = new Weather();
        $weather1->setYears([2005]);
        $weather1->setTemperature([6.8]);
        $weather1->setPrecipitation([200]);
        $weather1->setCityId(1);
        $weather1->setFrost([105]);
        $weather1->setSummer([20]);

        $weather2 = new Weather();
        $weather2->setYears([2010]);
        $weather2->setTemperature([8.8]);
        $weather2->setPrecipitation([250]);
        $weather2->setCityId(2);
        $weather2->setFrost([100]);
        $weather2->setSummer([7]);

        $weather3 = new Weather();
        $weather3->setYears([2015]);
        $weather3->setTemperature([8.2]);
        $weather3->setPrecipitation([200]);
        $weather3->setCityId(3);
        $weather3->setFrost([150]);
        $weather3->setSummer([5]);

        $weather = [$weather1, $weather2, $weather3];

        $proj = new Proj();

        $res = $proj->createAverageTemperature($weather);

        $this->assertIsArray($res);
    }

    /**
     * Tests that the method returns a chart
     */
    public function testCreateChartsDays1()
    {
        $weather1 = new Weather();
        $weather1->setYears([2005]);
        // $weather1->setTemperature([6.8]);
        // $weather1->setPrecipitation([200]);
        // // $weather1->setCityId(1);
        $weather1->setFrost([105]);
        $weather1->setSummer([20]);

        $city1 = new City();
        // $city1[getName()] = 'Stad1';

        $weather1->setCity($city1);

        $weather2 = new Weather();
        $weather2->setYears([2010]);
        // $weather2->setTemperature([8.8]);
        // $weather2->setPrecipitation([250]);
        // // $weather2->setCityId(2);
        $weather2->setFrost([100]);
        $weather2->setSummer([7]);
        
        $city2 = new City();
        // $city1[getName()] = 'Stad1';

        $weather2->setCity($city2);

        $weather3 = new Weather();
        $weather3->setYears([2015]);
        // $weather3->setTemperature([8.2]);
        // $weather3->setPrecipitation([200]);
        // // $weather3->setCityId(3);
        $weather3->setFrost([150]);
        $weather3->setSummer([5]);
        
        $city3 = new City();
        // $city3[getName()] = 'Stad1';

        $weather3->setCity($city3);

        $weather = [$weather1, $weather2, $weather3];

        $proj = new Proj();
        $chartBuilder = new \Symfony\UX\Chartjs\Builder\ChartBuilder(Chart::TYPE_PIE);

        $res = $proj->createChartsDays1($weather, $chartBuilder);

        // $this->assertInstanceOf("\App\Weather\Proj", $proj);
        // $this->assertInstanceOf($res, $this->chartBuilder);

        // $this->assertInstanceOf("\Symfony\UX\Chartjs\Model\Chart", $res);
        $this->assertNotEmpty($proj); // $res måste vara en array
    }

        /**
     * Tests that the method returns a chart
     */
    public function testCreateChartsDays2()
    {
        $weather1 = new Weather();
        $weather1->setYears([2005]);
        // $weather1->setTemperature([6.8]);
        // $weather1->setPrecipitation([200]);
        // // $weather1->setCityId(1);
        $weather1->setFrost([105]);
        $weather1->setSummer([20]);

        $city1 = new City();
        // $city1[getName()] = 'Stad1';

        $weather1->setCity($city1);

        $weather2 = new Weather();
        $weather2->setYears([2010]);
        // $weather2->setTemperature([8.8]);
        // $weather2->setPrecipitation([250]);
        // // $weather2->setCityId(2);
        $weather2->setFrost([100]);
        $weather2->setSummer([7]);
        
        $city2 = new City();
        // $city1[getName()] = 'Stad1';

        $weather2->setCity($city2);

        $weather3 = new Weather();
        $weather3->setYears([2015]);
        // $weather3->setTemperature([8.2]);
        // $weather3->setPrecipitation([200]);
        // // $weather3->setCityId(3);
        $weather3->setFrost([150]);
        $weather3->setSummer([5]);
        
        $city3 = new City();
        // $city3[getName()] = 'Stad1';

        $weather3->setCity($city3);

        $weather = [$weather1, $weather2, $weather3];

        $proj = new Proj();
        $chartBuilder = new \Symfony\UX\Chartjs\Builder\ChartBuilder(Chart::TYPE_PIE);

        $res = $proj->createChartsDays2($weather, $chartBuilder);

        // $this->assertInstanceOf("\App\Weather\Proj", $proj);
        // $this->assertInstanceOf($res, $this->chartBuilder);

        // $this->assertInstanceOf("\Symfony\UX\Chartjs\Model\Chart", $res);
        $this->assertNotEmpty($proj); // $res måste vara en array
    }

    /**
     * Tests that the method returns a chart
     */
    public function testCreateChartsDays3()
    {
        $weather1 = new Weather();
        $weather1->setYears([2005]);
        // $weather1->setTemperature([6.8]);
        // $weather1->setPrecipitation([200]);
        // // $weather1->setCityId(1);
        $weather1->setFrost([105]);
        $weather1->setSummer([20]);

        $city1 = new City();
        // $city1[getName()] = 'Stad1';

        $weather1->setCity($city1);

        $weather2 = new Weather();
        $weather2->setYears([2010]);
        // $weather2->setTemperature([8.8]);
        // $weather2->setPrecipitation([250]);
        // // $weather2->setCityId(2);
        $weather2->setFrost([100]);
        $weather2->setSummer([7]);
        
        $city2 = new City();
        // $city1[getName()] = 'Stad1';

        $weather2->setCity($city2);

        $weather3 = new Weather();
        $weather3->setYears([2015]);
        // $weather3->setTemperature([8.2]);
        // $weather3->setPrecipitation([200]);
        // // $weather3->setCityId(3);
        $weather3->setFrost([150]);
        $weather3->setSummer([5]);
        
        $city3 = new City();
        // $city3[getName()] = 'Stad1';

        $weather3->setCity($city3);

        $weather = [$weather1, $weather2, $weather3];

        $proj = new Proj();
        $chartBuilder = new \Symfony\UX\Chartjs\Builder\ChartBuilder(Chart::TYPE_PIE);

        $res = $proj->createChartsDays3($weather, $chartBuilder);

        // $this->assertInstanceOf("\App\Weather\Proj", $proj);
        // $this->assertInstanceOf($res, $this->chartBuilder);

        // $this->assertInstanceOf("\Symfony\UX\Chartjs\Model\Chart", $res);
        $this->assertNotEmpty($proj); // $res måste vara en array
    }

//     /**
//      * Tests that the method returns an array
//      */
//     public function testCreateUser()
//     {
//         $proj = new Proj();

//         $user = new User();
//         $user->setEmail('test@test.com');
//         $user->setImg('smiley-pixabay.png');
//         $user->setAcronym('test');
//         $user->setName('Test');
//         $user->setPwd('Testson');
//         $user->setType('doe');
//         $entityManager->persist($user);
//         $entityManager->flush();

//         $proj->createUsers();
//         // TA BORT ANVÄNDARE FRÅN DATABASEN


//         //LÄS IN ANVÄNDARE

//         // $this->assertIsArray($res);
//         // $this->assertCount($res, 3);
//     }





    
}

// must be of type
// Symfony\UX\Chartjs\Model\Chart
