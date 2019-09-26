<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 26.09.2019
 * Time: 20:23
 */

namespace App\Controller;


use App\Entity\Firms;
use App\Repository\FirmsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;


class FirmsController extends AbstractController
{
    /**
     * @Route("/firm")
     */

    function index(FirmsRepository $firmsRepository) {

        $firms = $firmsRepository->findAll();
        return '';
    }

    /**
     * @param Request $request
     * @param Firms $firm
     * @Route("/firm/add" , name="addFirm")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    function add(Request $request) {
        $firm = new Firms(); // создаем новый обхект нужного нам Класса.
        $form = $this->createFormBuilder($firm) // создаем билдер для формы
            ->add('title', TextType::class) // добавляем нужные нам поля с нужным типом
            ->add('logo', FileType::class)
            ->getForm(); //получаем форму в переменную $form

        $form->handleRequest($request); //обрабатываем данные пришедшие с формы, после заполнения и отправки
        //происходит проверка метода, которым переданна форма и валидация данных,
        // если все хорошо, то данные записываются в объект $firm

        if ($form->isSubmitted() && $form->isValid()) { // если форма прошла проверки и отправлена submit

            $envAPIHost = $_SERVER['MY_API_HOST']; // получение параметра из .env файла
            $file = $form['logo']->getData(); // получение объекта файл из формы по имени поля
            $dir = $this->getParameter('uploadsPath'); //получение данных из config\services.yaml секция parametrs

            $fileName = date('ymd') . '.' . $file->guessExtension(); //пытаемся угадать расширение файла
            $file->move($dir, $fileName); //перемещение файла в папку с нвым именем

            $firm->setLogo($fileName); // обновление поля в объекте
            $this->getDoctrine()->getManager()->persist($firm); //связывание с базо данных нового объекта
            $this->getDoctrine()->getManager()->flush(); //запись в базу данных изменений
        }

        return $this->render('firm/add.html.twig',

            ['form'=> $form->createView()]);



    }



}