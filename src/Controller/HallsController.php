<?php

namespace App\Controller;

use App\Entity\Halls;
use App\Form\HallsType;
use App\Repository\HallsRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/halls")
 *
 */

class HallsController extends AbstractController
{
    /**
     * @Route("/", name="halls_index", methods={"GET"})
     */
    public function index(): Response
    {
        $halls = $this->getDoctrine()
            ->getRepository(Halls::class)
            ->findAll();


        return $this->render('halls/index.html.twig', [
            'halls' => $halls,
        ]);
    }

    /**
     * @Route("/new", name="halls_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hall = new Halls();
        $form = $this->createForm(HallsType::class, $hall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hall);
            $entityManager->flush();

            return $this->redirectToRoute('halls_index');
        }

        return $this->render('halls/new.html.twig', [
            'hall' => $hall,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="halls_show", methods={"GET"})
     */
    public function show(Halls $hall): Response
    {
        return $this->render('halls/show.html.twig', [
            'hall' => $hall,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="halls_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Halls $hall): Response
    {

        $form = $this->createForm(HallsType::class, $hall);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('halls_index');
        }
        return $this->render('halls/edit.html.twig', [
            'hall' => $hall,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="halls_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Halls $hall): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hall->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hall);
            $entityManager->flush();
        }

        return $this->redirectToRoute('halls_index');
    }

    /**
     * @Route("/search/{searchString}", name="hall_search")
     */
    public function search($searchString, HallsRepository $hallsRepository){

        $hall = $hallsRepository->findOneBy(['title' => $searchString ]);
        return $this->render(
            'halls/show.html.twig',
            ['hall'=>$hall]
        );
    }
    /**
     * @Route("/search2/{searchString}", name="hall_search2")
     * @ParamConverter("hall", options={"mapping"={"searchString"="title"}})
     */
    public function search2(?Halls $hall){
        return $this->render(
            'halls/show.html.twig',
            ['hall'=>$hall]
        );
    }

}
