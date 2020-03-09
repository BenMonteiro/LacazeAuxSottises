<?php

namespace App\Controller\Admin;

use App\Entity\Partners;
use App\Form\PartnersType;
use App\Repository\PartnersRepository;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("admin/partners")
 */
class PartnersController extends AdminController
{
    /**
     * @Route("/", name="partners_index", methods={"GET"})
     */
    public function index(PartnersRepository $partnersRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $partners = $partnersRepository->findAll();
        $partners = $paginator->paginate(
            $partners,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/partners/index.html.twig', [
            'partners' => $partners,
            'tabs' => $this->tabList,
        ]);
    }

    /**
     * @Route("/new", name="partners_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $partner = new Partners();
        $form = $this->createForm(PartnersType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($partner);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'Le partenaire ' . $partner->getName() . ' a été ajouté avec succès !'
            );

            return $this->redirectToRoute('partners_index');
        }

        return $this->render('admin/partners/new.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partners_show", methods={"GET"})
     */
    public function show(Partners $partner): Response
    {
        return $this->render('admin/partners/show.html.twig', [
            'partner' => $partner,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="partners_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Partners $partner): Response
    {
        $form = $this->createForm(PartnersType::class, $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'Le partenaire ' . $partner->getName() . ' a été mis à jour avec succès !'
            );

            return $this->redirectToRoute('partners_index');
        }

        return $this->render('admin/partners/edit.html.twig', [
            'partner' => $partner,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="partners_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Partners $partner): Response
    {
        $isValid = false;

        if ($this->isCsrfTokenValid('delete' . $partner->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($partner);
            $entityManager->flush();

            $isValid = true;
        }

        $this->addFlash(
            $isValid ? 'notice' : 'error',
            $isValid ? 'Le partenaire ' . $partner->getName() . ' a été supprimé avec succès !' : 'Une erreur est survenue, veuillez rééssayer ultérieurement'
        );

        return $this->redirectToRoute('partners_index');
    }
}
