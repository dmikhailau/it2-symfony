<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17.09.2019
 * Time: 19:52
 */

namespace App\Controller;

use App\Repository\HallsRepository;
use App\Repository\SeatsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /* @Route("/", name="main", methods={"GET"}) */
    public function main(HallsRepository $hallsRepository , SeatsRepository $seatsRepository)
    {
        $halls = $hallsRepository->findAll();
        $seats = $seatsRepository->findAll();
        dump($halls[0]->getSeats());
        foreach ($halls as $hall) {
            foreach ($hall->getSeats() as $seat)
                dump($seat);
        }
die;
        dump($halls);
        dd($seats);
//        $halls = $hallsRepository->find(1);
//        $halls = $hallsRepository->findBy([]);
//        $halls = $hallsRepository->findOneBy(1);

        return $this->render('main/index.html.twig',
            ['title' => 'home',
            'halls' => $halls,
            'seats' => $seats
            ]);
    }
}