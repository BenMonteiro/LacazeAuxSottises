<?php

namespace App\Controller\Admin;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/admin/company")
 */
class CompanyController extends AdminController
{
    /**
     * @Route("/", name="company_index", methods={"GET"})
     */
    public function index(CompanyRepository $companyRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $companies = $companyRepository->findBy([], ['name' => 'ASC']);
        $companies = $paginator->paginate(
            $companies,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/company/index.html.twig', [
            'companies' => $companies,
            'tabs' => $this->tabList
        ]);
    }

    /**
     * @Route("/new", name="company_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $company = new Company();

        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($company);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'La compagnie ' . $company->getName() . ' a été ajoutée avec succès !'
            );

            return $this->redirectToRoute('company_index');
        }

        return $this->render('admin/company/new.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_show", methods={"GET"})
     */
    public function show(Company $company): Response
    {
        return $this->render('admin/company/show.html.twig', [
            'company' => $company,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="company_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Company $company): Response
    {

        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'La compagnie ' . $company->getName() . ' a été mise à jour avec succès !'
            );

            return $this->redirectToRoute('company_index');
        }

        return $this->render('admin/company/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="company_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Company $company): Response
    {
        $isValid = false;
        if ($this->isCsrfTokenValid('delete' . $company->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($company);
            $entityManager->flush();

            $isValid = true;
        }

        $this->addFlash(
            $isValid ? 'notice' : 'error',
            $isValid ? 'La compagnie ' . $company->getName() . ' a été supprimée avec succès !' : 'Une erreur est survenue, veuillez rééssayer ultérieurement'
        );

        return $this->redirectToRoute('company_index');
    }
}
