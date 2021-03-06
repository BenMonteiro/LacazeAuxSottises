<?php

namespace App\Controller\Admin;

use App\Entity\Performance;
use App\Form\PerformanceType;
use App\Repository\PerformanceRepository;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Company;
use Symfony\Component\Routing\RouterInterface;
use App\Entity\Event;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("admin/performance")
 */
class PerformanceController extends AdminController
{
    protected $companyId = null;
    protected $eventId = null;
    protected $url = null;

    /**
     * @Route("/", name="performance_index", methods={"GET"})
     */
    public function index(PerformanceRepository $performanceRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $performances = $performanceRepository->findBy([], ['date' => 'ASC']);
        $performances = $paginator->paginate(
            $performances,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('admin/performance/index.html.twig', [
            'performances' => $performances,
            'tabs' => $this->tabList,
        ]);
    }

    /**
     * @Route("/new", name="performance_new", methods={"GET","POST"})
     */
    public function new(Request $request, RouterInterface $router): Response
    {
        if (isset($_SERVER["REQUEST_URI"])) {
            $uri = $_SERVER["REQUEST_URI"];
            $this->url = parse_url($uri, PHP_URL_PATH);
        }
        if (preg_match('#admin/performance/new#', $this->url) and !isset($_GET['company_id'])) {
            $companyFieldType = TextType::class;
            $companyFieldOptions = [
                'invalid_message' => 'That is not a valid company',
                'attr' => [
                    'class' => 'js-company-autocomplete',
                    'data-autocomplete-url' => $router->generate('utility_companies')
                ]
            ];
        } else {
            $companyFieldType = EntityType::class;
            $companyFieldOptions = [
                'class' => Company::class,
                // Thanks to this attribute, the field is rightly prefilled
                'choice_attr' => function ($choice, $key, $value) {
                    if (isset($_GET['company_id']) && $value === $_GET['company_id']) {
                        return ['selected' => ''];
                    } else {
                        return [];
                    }
                }
            ];
        }

        $eventFieldType = EntityType::class;
        $eventFieldOptions = [
            'class' => Event::class,
            // Thanks to this attribute, the field is rightly prefilled
            'choice_attr' => function ($choice, $key, $value) {
                if (isset($_GET['event_id']) && $value === $_GET['event_id']) {
                    return ['selected' => ''];
                } else {
                    return [];
                }
            }
        ];


        $performance = new Performance();
        $form = $this->createForm(PerformanceType::class, $performance, [
            'companyFieldType' => $companyFieldType,
            'companyFieldOptions' => $companyFieldOptions,
            'url' => $this->url,
            'eventFieldType' => $eventFieldType,
            'eventFieldOptions' => $eventFieldOptions
        ]);
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
