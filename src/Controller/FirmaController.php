<?php

namespace App\Controller;

use App\Entity\Firma;
use App\Form\FirmaType;
use App\Repository\FirmaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/firma")
 */
class FirmaController extends AbstractController
{
    /**
     * @Route("/", name="firma_index", methods={"GET"})
     */
    public function index(FirmaRepository $firmaRepository): Response
    {
        return $this->render('firma/index.html.twig', [
            'firmas' => $firmaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="firma_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $firma = new Firma();
        $form = $this->createForm(FirmaType::class, $firma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($firma);
            $entityManager->flush();

            return $this->redirectToRoute('firma_index');
        }

        return $this->render('firma/new.html.twig', [
            'firma' => $firma,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="firma_show", methods={"GET"})
     */
    public function show(Firma $firma): Response
    {
        return $this->render('firma/show.html.twig', [
            'firma' => $firma,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="firma_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Firma $firma): Response
    {
        $form = $this->createForm(FirmaType::class, $firma);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('firma_index');
        }

        return $this->render('firma/edit.html.twig', [
            'firma' => $firma,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="firma_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Firma $firma): Response
    {
        if ($this->isCsrfTokenValid('delete'.$firma->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($firma);
            $entityManager->flush();
        }

        return $this->redirectToRoute('firma_index');
    }
}
