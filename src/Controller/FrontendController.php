<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class FrontendController extends AbstractController
{
    /**
     * @Route("/frontend", name="frontend")
     */
    public function index()
    {
        return $this->render('frontend/index.html.twig', [
            'controller_name' => 'FrontendController',
        ]);
    }

    /**
         * @Route("/api/films/list", name="apiFilmsList")
     */
    public function getAllFilms(){
        $fileData = file_get_contents('https://gist.githubusercontent.com/tiangechen/b68782efa49a16edaf07dc2cdaa855ea/raw/0c794a9717f18b094eabab2cd6a6b9a226903577/movies.csv');
//        dump($fileData);








        $result = explode("\n", $fileData);
//        dump($result);

        $headers = str_getcsv(str_replace([' ','%'],'', (array_shift($result))));
        //dump($headers);
//        $headers = array_flip($headers);
//        dump($headers);

        $films = [];
        foreach ($result as $item) {
            $films[] =  array_combine($headers, str_getcsv($item));
        }
        //dd($films);`
        return new JsonResponse(['headers'=> $headers, 'films' => $films]);
    }
}
