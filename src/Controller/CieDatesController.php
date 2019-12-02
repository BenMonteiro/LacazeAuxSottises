<?php

namespace App\Controller;

use App\Entity\CieDates;
use App\Form\CieDatesType;
use App\Repository\CieDatesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cie/dates")
 */
class CieDatesController extends AbstractController
{
    /**
     * @Route("/", name="cie_dates_index", methods={"GET"})
     */
    public function index(CieDatesRepository $cieDatesRepository): Response
    {
        return $this->render('cie_dates/index.html.twig', [
            'cie_dates' => $cieDatesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cie_dates_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cieDate = new CieDates();
        $form = $this->createForm(CieDatesType::class, $cieDate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cieDate);
            $entityManager->flush();

            return $this->redirectToRoute('cie_dates_index');
        }

        return $this->render('cie_dates/new.html.twig', [
            'cie_date' => $cieDate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cie_dates_show", methods={"GET"})
     */
    public function show(CieDates $cieDate): Response
    {
        return $this->render('cie_dates/show.html.twig', [
            'cie_date' => $cieDate,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cie_dates_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CieDates $cieDate): Response
    {
        $form = $this->createForm(CieDatesType::class, $cieDate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cie_dates_index');
        }

        return $this->render('cie_dates/edit.html.twig', [
            'cie_date' => $cieDate,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cie_dates_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CieDates $cieDate): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cieDate->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cieDate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cie_dates_index');
    }
}
