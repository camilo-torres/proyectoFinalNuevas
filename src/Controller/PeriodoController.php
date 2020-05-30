<?php

namespace App\Controller;

use App\Entity\Periodo;
use App\Form\PeriodoType;
use App\Repository\PeriodoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/periodo")
 */
class PeriodoController extends AbstractController
{
    /**
     * @Route("/", name="periodo_index", methods={"GET"})
     */
    public function index(PeriodoRepository $periodoRepository): Response
    {
        return $this->render('periodo/index.html.twig', [
            'periodos' => $periodoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="periodo_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $periodo = new Periodo();
        $form = $this->createForm(PeriodoType::class, $periodo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($periodo);
            $entityManager->flush();

            return $this->redirectToRoute('periodo_index');
        }

        return $this->render('periodo/new.html.twig', [
            'periodo' => $periodo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="periodo_show", methods={"GET"})
     */
    public function show(Periodo $periodo): Response
    {
        return $this->render('periodo/show.html.twig', [
            'periodo' => $periodo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="periodo_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Periodo $periodo): Response
    {
        $form = $this->createForm(PeriodoType::class, $periodo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('periodo_index');
        }

        return $this->render('periodo/edit.html.twig', [
            'periodo' => $periodo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="periodo_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Periodo $periodo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$periodo->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($periodo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('periodo_index');
    }
}
