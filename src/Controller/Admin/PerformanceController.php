<?php

namespace App\Controller\Admin;

use App\Entity\Performance;
use App\Form\PerformanceType;
use App\Repository\PerformanceRepository;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/performance")
 */
class PerformanceController extends AdminController
{
    protected $companyId = null;
    protected $eventId = null;

    /**
     * @Route("/", name="performance_index", methods={"GET"})
     */
    public function index(PerformanceRepository $performanceRepository): Response
    {
        return $this->render('admin/performance/index.html.twig', [
            'performances' => $performanceRepository->findBy([], ['date' => 'ASC']),
            'tabs' => $this->tabList,
        ]);
    }

    /**
     * @Route("/new", name="performance_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $performance = new Performance();
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performance);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'La nouvelle représentation a été ajoutée avec succès !'
            );

            if (isset($_GET['company_id'])) {
                return $this->redirectToRoute(
                    'company_show',
                    ['id' => $_GET['company_id']]
                );
            } elseif (isset($_GET['event_id'])) {
                return $this->redirectToRoute(
                    'event_show',
                    ['id' => $_GET['event_id']]
                );
            }
            return $this->redirectToRoute('performance_index');
        }

        if (isset($_GET['company_id'])) {
            $this->companyId = $_GET['company_id'];
        } elseif (isset($_GET['event_id'])) {
            $this->eventId = $_GET['event_id'];
        }
        return $this->render('admin/performance/new.html.twig', [
            'performance' => $performance,
            'form' => $form->createView(),
            'event_id' => $this->eventId,
            'company_id' => $this->companyId
        ]);
    }

    /**
     * @Route("/{id}/edit", name="performance_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Performance $performance): Response
    {
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'La représentation a été mise à jour avec succès !'
            );

            if (isset($_GET['company_id'])) {
                $this->companyId = $_GET['company_id'];

                return $this->redirectToRoute(
                    'company_show',
                    ['id' => $this->companyId]
                );
            } elseif (isset($_GET['event_id'])) {
                $this->eventId = $_GET['event_id'];

                return $this->redirectToRoute(
                    'event_show',
                    ['id' => $this->eventId]
                );
            }

            return $this->redirectToRoute('performance_index');
        }

        if (isset($_GET['company_id'])) {
            $this->companyId = $_GET['company_id'];
        } elseif (isset($_GET['event_id'])) {
            $this->eventId = $_GET['event_id'];
        }

        return $this->render('admin/performance/edit.html.twig', [
            'performance' => $performance,
            'form' => $form->createView(),
            'event_id' => $this->eventId,
            'company_id' => $this->companyId
        ]);
    }

    /**
     * @Route("/{id}", name="performance_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Performance $performance): Response
    {
        if ($this->isCsrfTokenValid('delete' . $performance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($performance);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'La représentation a été supprimée avec succès !'
            );
        }

        if (!empty($_GET['company_id'])) {
            $this->companyId = $_GET['company_id'];

            return $this->redirectToRoute(
                'company_show',
                ['id' => $this->companyId]
            );
        } elseif (!empty($_GET['event_id'])) {
            $this->eventId = $_GET['event_id'];

            return $this->redirectToRoute(
                'event_show',
                ['id' => $this->eventId]
            );
        }
        return $this->redirectToRoute('performance_index');
    }
}
