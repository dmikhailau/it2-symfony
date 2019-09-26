<?php

namespace App\Controller;

use App\Entity\Seats;
use App\Form\SeatsType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seats")
 */
class SeatsController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/", name="seats_index", methods={"GET"})
     */
    public function index(): Response
    {
        $seats = $this->getDoctrine()
            ->getRepository(Seats::class)
            ->findAll();

        return $this->render('seats/index.html.twig', [
            'seats' => $seats,
        ]);
    }

    /**
     * @Route("/new", name="seats_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $seat = new Seats();
        $form = $this->createForm(SeatsType::class, $seat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seat);
            $entityManager->flush();

            return $this->redirectToRoute('seats_index');
        }

        return $this->render('seats/new.html.twig', [
            'seat' => $seat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seats_show", methods={"GET"})
     */
    public function show(Seats $seat): Response
    {
        return $this->render('seats/show.html.twig', [
            'seat' => $seat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seats_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Seats $seat): Response
    {
        $form = $this->createForm(SeatsType::class, $seat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seats_index');
        }

        return $this->render('seats/edit.html.twig', [
            'seat' => $seat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seats_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Seats $seat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seats_index');
    }
}
