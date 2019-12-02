<?php

namespace App\Controller;

use App\Entity\Cies;
use App\Form\CiesType;
use App\Repository\CiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cies")
 */
class CiesController extends AbstractController
{
    /**
     * @Route("/", name="cies_index", methods={"GET"})
     */
    public function index(CiesRepository $ciesRepository): Response
    {
        return $this->render('cies/index.html.twig', [
            'cies' => $ciesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cies_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cy = new Cies();
        $form = $this->createForm(CiesType::class, $cy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cy);
            $entityManager->flush();

            return $this->redirectToRoute('cies_index');
        }

        return $this->render('cies/new.html.twig', [
            'cy' => $cy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cies_show", methods={"GET"})
     */
    public function show(Cies $cy): Response
    {
        return $this->render('cies/show.html.twig', [
            'cy' => $cy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cies_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cies $cy): Response
    {
        $form = $this->createForm(CiesType::class, $cy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cies_index');
        }

        return $this->render('cies/edit.html.twig', [
            'cy' => $cy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cies_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cies $cy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cy->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cies_index');
    }
}
