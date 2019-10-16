<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{

    //list

    //detail

    //seans

    /**
     * @Route("/seans/{id}", name="seans" )
     */
//    function seans(Seans $seans, OrderRepository $orderRepository)
    function seans($id)
    {
        dump($id);
        $reservedSeats = [
            0 => ['x' => 1, 'y' =>1],
            1 => ['x' => 2, 'y' =>5],
            2 => ['x' => 2, 'y' =>4]
        ];
        $sortedSeats = [
            1 => [ 1 => 1,],
            2 => [ 4 => 1,
                5 => 1
            ]
        ];
        $cartSeats = [];




        $seatStates = [
            0 => 'close',
            1 => 'open',
            2 => 'reserved'
        ];

        $seans = [
            'date' => new \DateTime(),
            'price' => ['basic' => 10, 'comfort' => 20, 'vip' => 30],
            'hall' => [
                'rows' => [
                    0 => [
                        'id' => 1,
                        'type' => 'basic',
                        'seats' => [
                            0 => ['x' => 1, 'y' => 1, 'state' => 1],
                            1 => ['x' => 1, 'y' => 2, 'state' => 1],
                            2 => ['x' => 1, 'y' => 3, 'state' => 0],
                            3 => ['x' => 1, 'y' => 4, 'state' => 0],
                            4 => ['x' => 1, 'y' => 5, 'state' => 1],
                        ]
                    ],
                    1 => [
                        'id' => 1,
                        'type' => 'vip',
                        'seats' => [
                            0 => ['x' => 2, 'y' => 1, 'state' => 1],
                            1 => ['x' => 2, 'y' => 2, 'state' => 1],
                            2 => ['x' => 2, 'y' => 3, 'state' => 1],
                            3 => ['x' => 2, 'y' => 4, 'state' => 1],
                            4 => ['x' => 2, 'y' => 5, 'state' => 1],
                        ]
                    ]
                ]
            ],
            'film' => [
                'title' => 'Hunter',
                'year' => 2019
            ]
        ];

        foreach ($seans['hall']['rows'] as &$row) {
            foreach ($row['seats'] as &$seat) {
                if (isset($sortedSeats[$seat['x']]) && isset($sortedSeats[$seat['x']][$seat['y']])) {
                    $seat['state'] = 2;
                }
                //добавить проверку отложенных в корзину мест
            }
        }

        return $this->render('film/seans.html.twig', [
            'seans' => $seans,
            'reserved' => $sortedSeats,
            'seatStates' => $seatStates
        ]);

    }


    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
