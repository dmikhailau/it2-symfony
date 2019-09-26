<?php

namespace App\Controller;

use App\Entity\SeatTypes;
use App\Form\SeatTypesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seat/types")
 */
class SeatTypesController extends AbstractController
{
    /**
     * @Route("/", name="seat_types_index", methods={"GET"})
     */
    public function index(): Response
    {
        $seatTypes = $this->getDoctrine()
            ->getRepository(SeatTypes::class)
            ->findAll();

        return $this->render('seat_types/index.html.twig', [
            'seat_types' => $seatTypes,
        ]);
    }

    /**
     * @Route("/new", name="seat_types_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $seatType = new SeatTypes();
        $form = $this->createForm(SeatTypesType::class, $seatType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seatType);
            $entityManager->flush();

            return $this->redirectToRoute('seat_types_index');
        }

        return $this->render('seat_types/new.html.twig', [
            'seat_type' => $seatType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seat_types_show", methods={"GET"})
     */
    public function show(SeatTypes $seatType): Response
    {
        return $this->render('seat_types/show.html.twig', [
            'seat_type' => $seatType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seat_types_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SeatTypes $seatType): Response
    {
        $form = $this->createForm(SeatTypesType::class, $seatType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seat_types_index');
        }

        return $this->render('seat_types/edit.html.twig', [
            'seat_type' => $seatType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seat_types_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SeatTypes $seatType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seatType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seatType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seat_types_index');
    }
}
