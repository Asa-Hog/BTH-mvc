<?php

namespace App\Weather;

use App\Entity\User;
use App\Entity\Weather;
use Symfony\UX\Chartjs\Model\Chart;
use App\Repository\WeatherRepository;
use Doctrine\Persistence\ManagerRegistry;

class Proj
{
    // private ManagerRegistry $entityManager;

    // /**
    // * Constructor for the class
    // * @param Entitymanager corresponding to the weather class
    // */
    // public function __construct($entityManager)
    // {
    //     $this->$entityManager = $entityManager;
    // }

    /**
     * Method that creates users
     */
    public function createUsers($entityManager): void
    {
        $user = new User();
        $user->setEmail('doe@doe.com');
        $user->setImg('smiley-pixabay.png');
        $user->setAcronym('doe');
        $user->setName('doe');
        $user->setPwd('doe');
        $user->setType('doe');
        $entityManager->persist($user);

        $user = new User();
        $user->setEmail('admin@admin.com');
        $user->setImg('smiley-pixabay.png');
        $user->setAcronym('admin');
        $user->setName('admin');
        $user->setPwd('admin');
        $user->setType('admin');
        $entityManager->persist($user);

        $entityManager->flush();
    }


    /**
     * Method that reads the measurements and adds to the database
     */
    public function readToDatabase($entityManager
    ): void
    {
        // Vid större datamängder bättre att läsa in mätvärdena från fil
        $years = [2002, 2003, 2004, 2005, 2006, 2007, 2008, 2009, 2010, 2011, 2012, 2013, 2014, 2015, 2016, 2017, 2018, 2019, 2020, 2021];

        $temp1 = [2.6, 3.1, 2.4, 3.5, 3.4, 3.3, 3.3, 2.8, 0.9, 3.8, 2.3, 3.3, 4.1, 4.5, 3.1, 2.7, 2.9, 2.5, 5.0, 2.7];
        $prec1 = [379, 482,	525, 617, 578, 619, 565, 462, 529, 752, 818, 518, 514, 824, 606, 703, 523, 632, 732, 757];
        $precDays1 = [137,129,160,167,147,166,136,118,140,173,183,132,135,184,161,161,151,153,173,170];
        $frost1 = [196,186,191,180,185,179,195,187,197,164,182,179,174,166,180,195,184,191,168,187];
        $summer1 = [7,15,2,8,7,3,5,5,1,6,0,2,14,1,0,0,16,4,5,9];
        $cityId1 = 1;

        $temp2 = [8.1, 7.7, 7.6, 7.9, 8.4, 8.1, 8.5, 7.7, 6.0, 8.4, 7.2, 7.8, 8.8, 8.7, 8.2, 8.0, 8.8, 8.6, 9.7, 8.1];
        $prec2 = [481, 489,	533, 558, 549, 502, 634, 530, 553, 479, 779, 459, 614, 656, 472, 557, 345, 564, 504, 555];
        $precDays2 = [146, 148, 181, 161, 165, 179, 188, 175, 177, 158, 199, 144, 165, 166, 157, 166, 140, 168, 155, 146];
        $frost2 = [104,99,103,99,95,81,62,89,136,92,107,101,53,61,88,85,109,82,37,89];
        $summer2 = [49,30,10,16,44,18,24,19,28,28,3,21,33,9,22,8,56,29,29,39];
        $cityId2 = 2;

        $temp3 = [8.2, 7.5, 7.5, 7.7, 8.5, 8.4, 8.4, 7.5, 6.0, 8.1, 7.3, 7.4, 8.9, 8.8, 8.2, 8.2, 8.9, 9.0, 9.6, 8.1];
        $prec3 = [540, 522, 551, 503, 556, 605, 474, 456, 699, 451, 541, 548, 550, 447, 557, 551, 480, 474, 470, 612];
        $precDays3 = [145,135,155,128,137,115,173,155,162,143,172,148,163,145,136,171,143,173,152,154];
        $frost3 = [96,116,126,131,97,93,86,112,151,113,114,128,81,71,100,99,107,97,71,113];
        $summer3 = [32,13,7,14,27,9,9,6,22,4,10,5,20,7,6,6,44,24,19,28];
        $cityId3 = 3;

        // Lägg till mätvärden till databasen
        $weather1 = new Weather();
        $weather1->setYears($years);
        $weather1->setTemperature($temp1);
        $weather1->setPrecipitation($prec1);
        $weather1->setPrecDays($precDays1);
        $weather1->setFrost($frost1);
        $weather1->setSummer($summer1);
        $weather1->setCityId($cityId1);
        $entityManager->persist($weather1);
    
        $weather2 = new Weather();
        $weather2->setYears($years);
        $weather2->setTemperature($temp2);
        $weather2->setPrecipitation($prec2);
        $weather2->setPrecDays($precDays2);;
        $weather2->setFrost($frost2);
        $weather2->setSummer($summer2);
        $weather2->setCityId($cityId2);
        $entityManager->persist($weather2);

        $weather3 = new Weather();
        $weather3->setYears($years);
        $weather3->setTemperature($temp3);
        $weather3->setPrecipitation($prec3);
        $weather3->setPrecDays($precDays3);;
        $weather3->setFrost($frost3);
        $weather3->setSummer($summer3);
        $weather3->setCityId($cityId3);
        $entityManager->persist($weather3);

        $entityManager->flush();
    }

    /**
     * Method that creates charts from the weather data in the database
     * @return array with the charts
     */
    public function createCharts($weather, $chartBuilder): array 
    {
        $y1 = $weather[0]->getYears();
        $t1 = $weather[0]->getTemperature();
        $p1 = $weather[0]->getPrecipitation();
        $pd1 = $weather[0]->getPrecDays();
        $f1 = $weather[0]->getFrost();
        $s1 = $weather[0]->getSummer();
        $c1 = $weather[0]->getCityId();

        $y2 = $weather[1]->getYears();
        $t2 = $weather[1]->getTemperature();
        $p2 = $weather[1]->getPrecipitation();
        $pd2 = $weather[1]->getPrecDays();
        $f2 = $weather[1]->getFrost();
        $s2 = $weather[1]->getSummer();
        $c2 = $weather[1]->getCityId();

        $y3 = $weather[2]->getYears();
        $t3 = $weather[2]->getTemperature();
        $p3 = $weather[2]->getPrecipitation();
        $pd3 = $weather[2]->getPrecDays();
        $f3 = $weather[2]->getFrost();
        $s3 = $weather[2]->getSummer();
        $c3 = $weather[2]->getCityId();

        // Genomsnitt antal nederbördsdagar
        $t1Average = array_sum($t1)/count($t1);
        $t2Average = array_sum($t2)/count($t2);
        $t3Average = array_sum($t3)/count($t3);

        $chart1 = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart1->setData([
            'labels' => $y1,
            'datasets' => [
                [
                    'label' => $c1,
                    'backgroundColor' => 'rgb(165, 73, 19)',
                    'borderColor' => 'rgb(165, 73, 19)',
                    'data' => $t1,
                ],
                [
                    'label' => $c2,
                    'backgroundColor' => 'rgb(73, 19, 165)',
                    'borderColor' => 'rgb(73, 19, 165)',
                    'data' => $t2,
                ],
                [
                    'label' => $c3,
                    'backgroundColor' => 'rgb(19, 165, 73)',
                    'borderColor' => 'rgb(19, 165, 73)',
                    'data' => $t3,
                ],
            ],
        ]);

        $chart1->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 10,
                ]
            ],
        ]);

        $chart2 = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart2->setData([
            'labels' => $y1,
            'datasets' => [
                [
                    'label' => $c1,
                    'backgroundColor' => 'rgb(165, 73, 19)',
                    'borderColor' => 'rgb(165, 73, 19)',
                    'data' => $p1,
                ],
                [
                    'label' => $c2,
                    'backgroundColor' => 'rgb(73, 19, 165)',
                    'borderColor' => 'rgb(73, 19, 165)',
                    'data' => $p2,
                ],
                [
                    'label' => $c3,
                    'backgroundColor' => 'rgb(19, 165, 73)',
                    'borderColor' => 'rgb(19, 165, 73)',
                    'data' => $p3,
                ],
            ],
        ]);

        $chart2->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 900,
                ]
            ],
        ]);

        // Genomsnitt antal nederbördsdagar
        $pd1Average = array_sum($pd1)/count($pd1);
        $pd2Average = array_sum($pd2)/count($pd2);
        $pd3Average = array_sum($pd3)/count($pd3);

        $chart3 = $chartBuilder->createChart(Chart::TYPE_BAR);

        $chart3->setData([
            'labels' => [$c1, $c2, $c3],
            'datasets' => [
                [
                    // 'label' => [$c1, $c2, $c3],
                    'backgroundColor' => ['rgb(165, 73, 19)', 'rgb(73, 19, 165)', 'rgb(19, 165, 73)'],
                    'data' => [$pd1Average, $pd2Average, $pd3Average]
                ]]
        ]);

        $chart3->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 160,
                ]
            ],
        ]);


        // Genomsnitt antal frostdagar
        $f1Average = array_sum($f1)/count($f1);
        $f2Average = array_sum($f2)/count($f2);
        $f3Average = array_sum($f3)/count($f3);
        // Genomsnitt antal frostdagar
        $s1Average = array_sum($s1)/count($s1);
        $s2Average = array_sum($s2)/count($s2);
        $s3Average = array_sum($s3)/count($s3);

        $chart4 = $chartBuilder->createChart(Chart::TYPE_PIE);

        $chart4->setData([
            'labels' => ["frostdagar","sommardagar", "resterande"],
            'datasets' => [
                [
                'data'=> [$f1Average, $s1Average, 365-$f1Average-$s1Average ],
                'backgroundColor'=> [
                    'rgb(73, 19, 165)',
                    'rgb(19, 165, 73)',

                  'rgb(224, 224, 224)'
                ],
            ],
           ]

        ]);

        $chart5 = $chartBuilder->createChart(Chart::TYPE_PIE);

        $chart5->setData([
            'labels' => ["frostdagar","sommardagar", "resterande"],
            'datasets' => [
                [
                'data'=> [$f2[0], $s2[0], 365-$f2[0]-$s2[0] ],
                'backgroundColor'=> [
                    'rgb(73, 19, 165)',
                    'rgb(19, 165, 73)',
                  'rgb(224, 224, 224)'
                ],
            ],
           ]

        ]);

        $chart6 = $chartBuilder->createChart(Chart::TYPE_PIE);

        $chart6->setData([
            'labels' => ["frostdagar","sommardagar", "resterande"],
            'datasets' => [
                [
                'data'=> [$f3[0], $s3[0], 365-$f3[0]-$s3[0] ],
                'backgroundColor'=> [
                    'rgb(73, 19, 165)',
                    'rgb(19, 165, 73)',

                  'rgb(224, 224, 224)'
                ],
            ],
           ]

        ]);


        return [$chart1, $chart2, $chart3, $chart4, $chart5, $chart6, round($t1Average, 2), round($t2Average,2), round($t3Average,2)];
    }


}
