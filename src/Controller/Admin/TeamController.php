<?php

namespace App\Controller\Admin;

use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\TeamRepository;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/team")
 */
class TeamController extends AdminController
{
    /**
     * @Route("/", name="team_index", methods={"GET"})
     */
    public function index(TeamRepository $teamRepository): Response
    {
        return $this->render('admin/team/index.html.twig', [
            'teams' => $teamRepository->findAll(),
            'tabs' => $this->tabList,
        ]);
    }

    /**
     * @Route("/new", name="team_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($team);
            $entityManager->flush();

            return $this->redirectToRoute('team_index');
        }

        return $this->render('admin/team/new.html.twig', [
            'team' => $team,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="team_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Team $team): Response
    {
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('team_index');
        }

        return $this->render('admin/team/edit.html.twig', [
            'team' => $team,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="team_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Team $team): Response
    {
        if ($this->isCsrfTokenValid('delete' . $team->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($team);
            $entityManager->flush();
        }

        return $this->redirectToRoute('team_index');
    }
}
