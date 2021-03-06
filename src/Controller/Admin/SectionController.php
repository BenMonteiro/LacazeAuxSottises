<?php

namespace App\Controller\Admin;

use App\Entity\Section;
use App\Form\SectionType;
use App\Repository\SectionRepository;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/section")
 */
class SectionController extends AdminController
{
    /**
     * @Route("/new", name="section_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $section = new Section();
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($section);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Le paragraphe ' . $section->getName() . ' a été ajouté avec succès !'
            );

            if (isset($_GET['page_id'])) {
                return $this->redirectToRoute(
                    'page_list_show',
                    ['id' => $_GET['page_id']]
                );
            }

            return $this->redirectToRoute('admin_dashboard');
        }

        $page = (isset($_GET['page_id'])) ? $_GET['page_id'] : null;

        return $this->render('admin/section/new.html.twig', [
            'section' => $section,
            'page' => $page,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id<\d+>}", name="section_show", methods={"GET"})
     */
    public function show(Section $section): Response
    {
        return $this->render('admin/section/show.html.twig', [
            'section' => $section,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="section_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Section $section): Response
    {
        $form = $this->createForm(SectionType::class, $section);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Le paragraphe ' . $section->getName() . ' a été mis à jour avec succès !'
            );

            if (isset($_GET['page_id'])) {
                return $this->redirectToRoute(
                    'page_list_show',
                    ['id' => $_GET['page_id']]
                );
            }

            return $this->redirectToRoute('admin_dashboard');
        }

        return $this->render('admin/section/edit.html.twig', [
            'section' => $section,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="section_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Section $section): Response
    {
        if ($this->isCsrfTokenValid('delete' . $section->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($section);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Le paragraphe ' . $section->getName() . ' a été supprimé avec succès !'
            );
        }


        if (isset($_GET['page_id'])) {
            return $this->redirectToRoute(
                'page_list_show',
                ['id' => $_GET['page_id']]
            );
        }

        return $this->redirectToRoute('admin_dashboard');
    }
}
