<?php

namespace App\Controller\Admin;

use App\Controller\Admin\AdminController;
use App\Entity\PressDocument;
use App\Form\PressDocumentType;
use App\Repository\PressDocumentRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/press/document")
 */
class PressDocumentController extends AdminController
{
    /**
     * @Route("/", name="press_document_index", methods={"GET"})
     */
    public function index(PressDocumentRepository $pressDocumentRepository): Response
    {
        return $this->render('admin/press_document/index.html.twig', [
            'press_documents' => $pressDocumentRepository->findAll(),
            'tabs' => $this->tabList
        ]);
    }

    /**
     * @Route("/new", name="press_document_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pressDocument = new PressDocument();
        $form = $this->createForm(PressDocumentType::class, $pressDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pressDocument);
            $entityManager->flush();

            return $this->redirectToRoute('press_document_index');
        }

        return $this->render('admin/press_document/new.html.twig', [
            'press_document' => $pressDocument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="press_document_show", methods={"GET"})
     */
    public function show(PressDocument $pressDocument): Response
    {
        return $this->render('admin/press_document/show.html.twig', [
            'press_document' => $pressDocument,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="press_document_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PressDocument $pressDocument): Response
    {
        $form = $this->createForm(PressDocumentType::class, $pressDocument);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('press_document_index');
        }

        return $this->render('admin/press_document/edit.html.twig', [
            'press_document' => $pressDocument,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="press_document_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PressDocument $pressDocument): Response
    {
        if ($this->isCsrfTokenValid('delete' . $pressDocument->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pressDocument);
            $entityManager->flush();
        }

        return $this->redirectToRoute('press_document_index');
    }
}
