<?php

namespace App\Weather;

use App\Entity\User;
use App\Entity\Weather;
use App\Entity\City;
use Symfony\UX\Chartjs\Model\Chart;
use Doctrine\Persistence\ManagerRegistry;

class Proj
{
    /**
     * Method that creates users
     * @param \Doctrine\ORM\EntityManager $entityManager Doctrine manager that handles the database
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
     * @param  \Doctrine\ORM\EntityManager $entityManager Doctrine manager that handles the database
     */
    public function readToDatabase(
        $entityManager
    ): void {
        // Vid större datamängder bättre att läsa in mätvärdena från fil
        $years = [2002,2003,2004,2005,2006,2007,2008,2009,2010,2011,2012,2013,2014,2015,2016,2017,2018,2019,2020,2021];

        $temp1 = [2.6,3.1,2.4,3.5,3.4,3.3,3.3,2.8,0.9,3.8,2.3,3.3,4.1,4.5,3.1,2.7,2.9,2.5,5.0,2.7];
        $prec1 = [379,482,525,617,578,619,565,462,529,752,818,518,514,824,606,703,523,632,732,757];
        $precDays1 = [137,129,160,167,147,166,136,118,140,173,183,132,135,184,161,161,151,153,173,170];
        $frost1 = [196,186,191,180,185,179,195,187,197,164,182,179,174,166,180,195,184,191,168,187];
        $summer1 = [7,15,2,8,7,3,5,5,1,6,0,2,14,1,0,0,16,4,5,9];
        // $cityId1 = 1;

        $temp2 = [8.1,7.7,7.6,7.9,8.4,8.1,8.5,7.7,6.0,8.4,7.2,7.8,8.8,8.7,8.2,8.0,8.8,8.6,9.7,8.1];
        $prec2 = [481, 489, 533, 558, 549, 502, 634, 530, 553, 479, 779, 459, 614, 656, 472, 557, 345, 564, 504, 555];
        $precDays2 = [146,148,181,161,165,179,188,175,177,158,199,144,165,166,157,166,140,168,155,146];
        $frost2 = [104,99,103,99,95,81,62,89,136,92,107,101,53,61,88,85,109,82,37,89];
        $summer2 = [49,30,10,16,44,18,24,19,28,28,3,21,33,9,22,8,56,29,29,39];
        // $cityId2 = 2;

        $temp3 = [8.2, 7.5, 7.5, 7.7, 8.5, 8.4, 8.4, 7.5, 6.0, 8.1, 7.3, 7.4, 8.9, 8.8, 8.2, 8.2, 8.9, 9.0, 9.6, 8.1];
        $prec3 = [540, 522, 551, 503, 556, 605, 474, 456, 699, 451, 541, 548, 550, 447, 557, 551, 480, 474, 470, 612];
        $precDays3 = [145,135,155,128,137,115,173,155,162,143,172,148,163,145,136,171,143,173,152,154];
        $frost3 = [96,116,126,131,97,93,86,112,151,113,114,128,81,71,100,99,107,97,71,113];
        $summer3 = [32,13,7,14,27,9,9,6,22,4,10,5,20,7,6,6,44,24,19,28];
        // $cityId3 = 3;

        //------------------------------------------------------------

        $cityInfo1 = ['Luleå', '65.584819', '22.1567026'];
        $cityInfo2 = ['Stockholm', '59.3194903', '18.0750600'];
        $cityInfo3 = ['Kalmar', '56.6634447', '16.3629'];

        //------------------------------------------------------------
        // Lägg till mätvärden till databasen
        $city1 = new City();
        $city1->setName($cityInfo1[0]);
        $city1->setLongitude($cityInfo1[1]);
        $city1->setLatitude($cityInfo1[2]);

        $weather1 = new Weather();
        $weather1->setYears($years);
        $weather1->setTemperature($temp1);
        $weather1->setPrecipitation($prec1);
        $weather1->setPrecDays($precDays1);
        $weather1->setFrost($frost1);
        $weather1->setSummer($summer1);
        // $weather1->setCityId($cityId1);

        $weather1->setCity($city1);

        $entityManager->persist($city1);
        $entityManager->persist($weather1);


        $city2 = new City();
        $city2->setName($cityInfo2[0]);
        $city2->setLongitude($cityInfo2[1]);
        $city2->setLatitude($cityInfo2[2]);

        $weather2 = new Weather();
        $weather2->setYears($years);
        $weather2->setTemperature($temp2);
        $weather2->setPrecipitation($prec2);
        $weather2->setPrecDays($precDays2);
        $weather2->setFrost($frost2);
        $weather2->setSummer($summer2);
        // $weather2->setCityId($cityId2);

        $weather2->setCity($city2);

        $entityManager->persist($city2);
        $entityManager->persist($weather2);


        $city3 = new City();
        $city3->setName($cityInfo3[0]);
        $city3->setLongitude($cityInfo3[1]);
        $city3->setLatitude($cityInfo3[2]);

        $weather3 = new Weather();
        $weather3->setYears($years);
        $weather3->setTemperature($temp3);
        $weather3->setPrecipitation($prec3);
        $weather3->setPrecDays($precDays3);
        $weather3->setFrost($frost3);
        $weather3->setSummer($summer3);
        // $weather3->setCityId($cityId3);

        $weather3->setCity($city3);

        $entityManager->persist($city3);
        $entityManager->persist($weather3);

        //------------------------------------------------------------

        $entityManager->flush();
    }

    /**
     * Method that creates a temperature chart from the weather data in the database for all cities
     * @param Weather $weather Data from the weather repository
     * @param \Symfony\UX\Chartjs\Builder\ChartBuilderInterface $chartBuilder Tool that creates the chart
     * @return array The chart as element
     */
    public function createChartTemperature($weather, $chartBuilder): array
    {
        $years1 = $weather[0]->getYears();
        $temp1 = $weather[0]->getTemperature();
        // $city1 = $weather[0]->getCityId(); // Ger id:t
        $city1 = $weather[0]->getCity()->getName();
        // var_dump($weather[0]->getCity());
        // var_dump($weather[0]->getCity()->getWeather()->getCity()->getName());


        // $years2 = $weather[1]->getYears();
        $temp2 = $weather[1]->getTemperature();
        // $city2 = $weather[1]->getCityId();
        $city2 = $weather[1]->getCity()->getName();

        // $years3 = $weather[2]->getYears();
        $temp3 = $weather[2]->getTemperature();
        // $city3 = $weather[2]->getCityId();
        $city3 = $weather[2]->getCity()->getName();

        $chart1 = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart1->setData([
            'labels' => $years1,
            'datasets' => [
                [
                    'label' => $city1,
                    'backgroundColor' => 'rgb(165, 73, 19)',
                    'borderColor' => 'rgb(165, 73, 19)',
                    'data' => $temp1,
                ],
                [
                    'label' => $city2,
                    'backgroundColor' => 'rgb(73, 19, 165)',
                    'borderColor' => 'rgb(73, 19, 165)',
                    'data' => $temp2,
                ],
                [
                    'label' => $city3,
                    'backgroundColor' => 'rgb(19, 165, 73)',
                    'borderColor' => 'rgb(19, 165, 73)',
                    'data' => $temp3,
                ],
            ],
        ]);


        $chart1->setOptions([
            // 'responsive' => true,
            'plugins' => [
            'title' => [
                'display' => true,
                'text' => 'Årsmedeltemperatur',
                'fontSize' => 16
            ]
            ],
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 10,
                    'title' => [
                        'display'  => true,
                        'text'     => '°C',
                    ]
                    ],
                    'x' => [
                        'title' => [
                            'display'  => true,
                            'text'     => 'år',
                        ]
                    ]
            ],
        ]);
        return [$chart1];
    }

    /**
     * Method that creates a precipitation chart from the weather data in the database for all
     * cities
     * @param Weather $weather Data from the weather repository
     * @param \Symfony\UX\Chartjs\Builder\ChartBuilderInterface $chartBuilder Tool that creates the chart
     * @return array The chart as element
     */
    public function createChartsPrecipitation($weather, $chartBuilder): array
    {
        $years1 = $weather[0]->getYears();
        $prec1 = $weather[0]->getPrecipitation();
        // $city1 = $weather[0]->getCityId();
        $city1 = $weather[0]->getCity()->getName();

        // $years2 = $weather[1]->getYears();
        $prec2 = $weather[1]->getPrecipitation();
        // $city2 = $weather[1]->getCityId();
        $city2 = $weather[1]->getCity()->getName();

        // $years3 = $weather[2]->getYears();
        $prec3 = $weather[2]->getPrecipitation();
        // $city3 = $weather[2]->getCityId();
        $city3 = $weather[2]->getCity()->getName();

        $chart2 = $chartBuilder->createChart(Chart::TYPE_LINE);

        $chart2->setData([
            'labels' => $years1,
            'datasets' => [
                [
                    'label' => $city1,
                    'backgroundColor' => 'rgb(165, 73, 19)',
                    'borderColor' => 'rgb(165, 73, 19)',
                    'data' => $prec1,
                ],
                [
                    'label' => $city2,
                    'backgroundColor' => 'rgb(73, 19, 165)',
                    'borderColor' => 'rgb(73, 19, 165)',
                    'data' => $prec2,
                ],
                [
                    'label' => $city3,
                    'backgroundColor' => 'rgb(19, 165, 73)',
                    'borderColor' => 'rgb(19, 165, 73)',
                    'data' => $prec3,
                ],
            ],
        ]);

        $chart2->setOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Nederbörd',
                    'fontSize' => 16,
                    'color' => '#d3d3d3',
                    'font' => [
                        'weight' => 'bolder'
                    ]
                ]
                ],
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 900,
                    'ticks' => [
                        'color' => '#d3d3d3'
                    ],
                    'title' => [
                        'display'  => true,
                        'text'     => 'mm',
                        'color' => '#d3d3d3',
                    ]],
                'x' => [
                    'title' => [
                        'display'  => true,
                        'text'     => 'år',
                        'color' => '#d3d3d3'
                    ],
                    'ticks' => [
                        'color' => '#d3d3d3'
                    ],
                ]
            ]
        ]);

        return [$chart2];
    }

    /**
     * Method that creates a precipitation chart over number of precipitation days from the weather
     * data in the database for all cities
     * @param Weather $weather Data from the weather repository
     * @param \Symfony\UX\Chartjs\Builder\ChartBuilderInterface $chartBuilder Tool that creates the chart
     * @return array The chart as element
     */
    public function createChartsPrecipitationDays($weather, $chartBuilder): array
    {
        $pd1 = $weather[0]->getPrecDays();
        // $city1 = $weather[0]->getCityId();
        $city1 = $weather[0]->getCity()->getName();

        // $years2 = $weather[1]->getYears();
        $pd2 = $weather[1]->getPrecDays();
        // $city2 = $weather[1]->getCityId();
        $city2 = $weather[1]->getCity()->getName();

        // $years3 = $weather[2]->getYears();
        $pd3 = $weather[2]->getPrecDays();
        // $city3 = $weather[2]->getCityId();
        $city3 = $weather[2]->getCity()->getName();

        // Genomsnitt antal nederbördsdagar
        $pd1Average = array_sum($pd1) / count($pd1);
        $pd2Average = array_sum($pd2) / count($pd2);
        $pd3Average = array_sum($pd3) / count($pd3);

        $chart3 = $chartBuilder->createChart(Chart::TYPE_BAR);

        $chart3->setData([
            'labels' => [''],
            'datasets' => [
                [
                    'label' => $city1,
                    'backgroundColor' => ['rgb(165, 73, 19)'],
                    'data' => [$pd1Average]
                ],
                [
                    'label' => $city2,
                    'backgroundColor' => ['rgb(73, 19, 165)'],
                    'data' => [$pd2Average]
                ],
                [
                    'label' => $city3,
                    'backgroundColor' => ['rgb(19, 165, 73)'],
                    'data' => [$pd3Average]
                ]]
        ]);

        $chart3->setOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => 'Antal nederbördsdagar',
                    'color' => '#d3d3d3',
                    'fontSize' => 16,
                    'font' => [
                        'weight' => 'bolder'
                    ],
                ]
                ],
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 160,
                    'title' => [
                        'display'  => true,
                        'text'     => 'antal dagar',
                        'color' => '#d3d3d3'
                    ],
                    'ticks' => [
                        'color' => '#d3d3d3',
                    ]],
                'x' => [
                    'title' => [
                        'display'  => true,
                        'text'     => 'stad',
                        'color' => '#d3d3d3'
                    ],
                    'ticks' => [
                        'color' => '#d3d3d3'
                    ],
                ]
            ],
        ]);
        return [$chart3];
    }

    /**
     * Method that creates a chart over average frost- and summer days percentage of a year from
     * the weather data in the database for city 1
     * @param Weather $weather Data from the weather repository
     * @param \Symfony\UX\Chartjs\Builder\ChartBuilderInterface $chartBuilder Tool that creates the chart
     * @return array The chart as element
     */
    public function createChartsDays1($weather, $chartBuilder): array
    {
        $frost1 = $weather[0]->getFrost();
        $summer1 = $weather[0]->getSummer();

        // Genomsnitt antal frostdagar
        $frost1Average = array_sum($frost1) / count($frost1);
        // Genomsnitt antal högsommardagar
        $summer1Average = array_sum($summer1) / count($summer1);

        $chart4 = $chartBuilder->createChart(Chart::TYPE_PIE);

        $chart4->setData([
            'labels' => ["frostdagar","högsommardagar", "resterande"],
            'datasets' => [
                [
                'data' => [$frost1Average, $summer1Average, 365 - $frost1Average - $summer1Average],
                'backgroundColor' => [
                    'rgb(73, 19, 165)',
                    'rgb(19, 165, 73)',
                    'rgb(224, 224, 224)'
                ],
                ],
            ]

        ]);

        $chart4->setOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'position' => 'top',
                    'text' => 'Andel frost- och högsommardagar',
                    'fontSize' => 16
                ],
                'subtitle' => [
                    'display' => true,
                    'position' => 'bottom',
                    'text' => $weather[0]->getCity()->getName()
                ]],
        ]);

        return [$chart4];
    }
    /**
     * Method that creates a chart over average frost- and summer days percentage of a year from
     * the weather data in the database for city 2
     * @param Weather $weather Data from the weather repository
     * @param \Symfony\UX\Chartjs\Builder\ChartBuilderInterface $chartBuilder Tool that creates the chart
     * @return array The chart as element
     */
    public function createChartsDays2($weather, $chartBuilder): array
    {
        $frost2 = $weather[1]->getFrost();
        $summer2 = $weather[1]->getSummer();


        // Genomsnitt antal frostdagar
        $frost2Average = array_sum($frost2) / count($frost2);
        // Genomsnitt antal högsommardagar
        $summer2Average = array_sum($summer2) / count($summer2);

        $chart5 = $chartBuilder->createChart(Chart::TYPE_PIE);

        $chart5->setData([
            'labels' => ["frostdagar","högsommardagar", "resterande"],
            'datasets' => [
                [
                'data' => [$frost2Average, $summer2Average, 365 - $frost2Average - $summer2Average],
                'backgroundColor' => [
                    'rgb(73, 19, 165)',
                    'rgb(19, 165, 73)',
                    'rgb(224, 224, 224)'
                ],
                ],
            ]

        ]);
        $chart5->setOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'position' => 'top',
                    'text' => 'Andel frost- och högsommardagar',
                    'fontSize' => 16
                ],
                'subtitle' => [
                    'display' => true,
                    'position' => 'bottom',
                    'text' => $weather[1]->getCity()->getName()
                ]],
        ]);

        return [$chart5];
    }

    /**
    * Method that creates a chart over average frost- and summer days percentage of a year from the
    * weather data in the database for city 3
    * @param Weather $weather Data from the weather repository
    * @param \Symfony\UX\Chartjs\Builder\ChartBuilderInterface $chartBuilder Tool that creates the chart
    * @return array The chart as element
    */
    public function createChartsDays3($weather, $chartBuilder): array
    {
        $frost3 = $weather[2]->getFrost();
        $summer3 = $weather[2]->getSummer();

        // Genomsnitt antal frostdagar
        $frost3Average = array_sum($frost3) / count($frost3);
        // Genomsnitt antal högsommardagar
        $summer3Average = array_sum($summer3) / count($summer3);

        $chart6 = $chartBuilder->createChart(Chart::TYPE_PIE);

        $chart6->setData([
            'labels' => ["frostdagar","högsommardagar", "resterande"],
            'datasets' => [
                [
                'data' => [$frost3Average, $summer3Average, 365 - $frost3Average - $summer3Average],
                'backgroundColor' => [
                    'rgb(73, 19, 165)',
                    'rgb(19, 165, 73)',
                    'rgb(224, 224, 224)'
                ],
                ],
            ]

        ]);
        $chart6->setOptions([
            'plugins' => [
                'title' => [
                    'display' => true,
                    'position' => 'top',
                    'text' => 'Andel frost- och högsommardagar',
                    'fontSize' => 16
                ],
                'subtitle' => [
                    'display' => true,
                    'position' => 'bottom',
                    'text' => $weather[2]->getCity()->getName()
                ]],
        ]);

        return [$chart6];
    }

    /**
     * Method that returns average temperature from the weather data in the database
     * @param Weather $weather Data from the weather repository
     * @return array Array with the rounded average temperatures for each city as the elements
     */
    public function createAverageTemperature($weather): array
    {
        $temp1 = $weather[0]->getTemperature();
        $temp2 = $weather[1]->getTemperature();
        $temp3 = $weather[2]->getTemperature();

        // Genomsnitt årsmedeltemperatur
        $temp1Average = array_sum($temp1) / count($temp1);
        $temp2Average = array_sum($temp2) / count($temp2);
        $temp3Average = array_sum($temp3) / count($temp3);

        // Genomsnitt årsmedeltemperatur avrundat
        $temp1AverageRound = round($temp1Average, 2);
        $temp2AverageRound = round($temp2Average, 2);
        $temp3AverageRound = round($temp3Average, 2);

        return [$temp1AverageRound, $temp2AverageRound, $temp3AverageRound];
    }
}
