<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


/**
 * @Route("/admin/event")
 */
class EventController extends AdminController
{
    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository, PaginatorInterface $paginator, Request $request): Response
    {

        $events = $eventRepository->findBy([], ['startingDate' => 'ASC']);
        $events = $paginator->paginate(
            $events,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('admin/event/index.html.twig', [
            'events' => $events,
            'tabs' => $this->tabList,
        ]);
    }

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            $this->addFlash(
                'notice',
                'L\'événement ' . $event->getName() . ' a été ajouté avec succès !'
            );

            return $this->redirectToRoute('event_index');
        }

        return $this->render('admin/event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('admin/event/show.html.twig', [
            'event' => $event,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'notice',
                'L\'événement ' . $event->getName() . ' a été mis à jour avec succès !'
            );

            return $this->redirectToRoute('event_index');
        }

        return $this->render('admin/event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Event $event): Response
    {
        $isValid = false;

        if ($this->isCsrfTokenValid('delete' . $event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();

            $isValid = true;
        }

        $this->addFlash(
            $isValid ? 'notice' : 'error',
            $isValid ? 'L\'événement ' . $event->getName() . ' a été supprimé avec succès !' : 'Une erreur est survenue, veuillez rééssayer ultérieurement'
        );
        return $this->redirectToRoute('event_index');
    }
}
