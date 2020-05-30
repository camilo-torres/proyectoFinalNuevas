<?php

namespace App\Controller;

use App\Entity\Orden;
use App\Form\OrdenType;
use App\Repository\OrdenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/orden")
 */
class OrdenController extends AbstractController
{
    /**
     * @Route("/", name="orden_index", methods={"GET"})
     */
    public function index(OrdenRepository $ordenRepository): Response
    {
        return $this->render('orden/index.html.twig', [
            'ordens' => $ordenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="orden_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $orden = new Orden();
        $form = $this->createForm(OrdenType::class, $orden);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($orden);
            $entityManager->flush();

            return $this->redirectToRoute('orden_index');
        }

        return $this->render('orden/new.html.twig', [
            'orden' => $orden,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="orden_show", methods={"GET"})
     */
    public function show(Orden $orden): Response
    {
        return $this->render('orden/show.html.twig', [
            'orden' => $orden,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="orden_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Orden $orden): Response
    {
        $form = $this->createForm(OrdenType::class, $orden);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orden_index');
        }

        return $this->render('orden/edit.html.twig', [
            'orden' => $orden,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="orden_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Orden $orden): Response
    {
        if ($this->isCsrfTokenValid('delete'.$orden->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($orden);
            $entityManager->flush();
        }

        return $this->redirectToRoute('orden_index');
    }
}
