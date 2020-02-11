<?php

namespace App\Controller;

use App\Entity\FrontPage;
use App\Repository\FrontPageRepository;
use App\Repository\FrontTabRepository;
use App\Repository\SectionRepository;
use App\Repository\EventRepository;
use App\Entity\Event;
use App\Repository\PerformanceRepository;
use App\Repository\CompanyRepository;
use App\Entity\Company;
use App\Repository\PartnersRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    protected $pages;
    protected $tabs;

    public function __construct(
        FrontPageRepository $frontPageRepository,
        FrontTabRepository $frontTabRepository
    ) {
        $this->pages = $frontPageRepository->findAll();
        $this->tabs = $frontTabRepository->findAll();
    }

    /**
     * @Route("/", name="blog")
     */
    public function index()
    {
        return $this->render('front/landing_page.html.twig');
    }

    /**
     * @Route("/accueil", name="home")
     */
    public function home()
    {
        return $this->render('front/home.html.twig', [
            'tabs' => $this->tabs,
            'pages' => $this->pages,
        ]);
    }

    /**
     * @Route("page/{pageSlug}", name="page_show", requirements={"pageSlug"=".+?"}, methods={"GET"})
     */
    public function displayPage(
        FrontPage $frontPage,
        SectionRepository $sectionRepository,
        EventRepository $eventRepository,
        PerformanceRepository $performanceRepository,
        CompanyRepository $companyRepository,
        PartnersRepository $partnersRepository
    ): Response {
        $pageFolder = $frontPage->getTab();
        $pageTemplate = $frontPage->getTemplate();
        $defaultTemplate = 'front/page_default.html.twig';

        $template = (empty($pageTemplate)) ? $defaultTemplate : 'front/' . $pageFolder . '/' . $pageTemplate . '.html.twig';

        $homeEvents = ($frontPage->getPageSlug() === 'home') ? $eventRepository->findBy(['isHighlight' => true], ['startingDate' => 'ASC']) : null;
        $homePerfs = ($frontPage->getPageSlug() === 'home') ? $performanceRepository->findBy(['isHighlight' => true], ['date' => 'ASC']) : null;
        $seasonEvents = ($frontPage->getPageSlug() === 'saison/calendrier') ? $eventRepository->findSeasonEvents() : null;
        $seasonPerformances = ($frontPage->getPageSlug() === 'saison/calendrier') ? $performanceRepository->findBy(['event' => 29], ['date' => 'ASC']) : null;
        $festPerformances = ($frontPage->getPageSlug() === 'festival/calendrier') ? $performanceRepository->findBy(['event' => 'festival'], ['date' => 'ASC']) : null;
        $placeEventPerfs = ($frontPage->getPageSlug() === 'tiers-lieu/les-rendez-vous') ? $performanceRepository->findBy(['event' => 31], ['date' => 'ASC']) : null;
        $partners = ($frontPage->getPageSlug() === 'partenaires/partenaires') ? $partnersRepository->findAll() : null;


        return $this->render($template, [
            'page' => $frontPage,
            'pages' => $this->pages,
            'tabs' => $this->tabs,
            'sections' => $sectionRepository->findBy(['belongToPage' => $frontPage], ['appearanceOrder' => 'ASC']),
            'companies' => $companyRepository->findBy([], ['name' => 'ASC']),
            'season' => $eventRepository->find(29),
            'seasonEvents' => $seasonEvents,
            'seasonPerfs' => $seasonPerformances,
            'festPerfs' => $festPerformances,
            'placeEventPerfs' => $placeEventPerfs,
            'partners' => $partners,
            'homeEvents' => $homeEvents,
            'homePerfs' => $homePerfs
        ]);
    }


    /**
     * @Route("company/{id<\d+>}", name="display_company", methods={"GET"})
     */
    public function displayCompanyCard(Company $company): Response
    {
        return $this->render('front/display_company.html.twig', [
            'pages' => $this->pages,
            'tabs' => $this->tabs,
            'company' => $company,
        ]);
    }

    /**
     * @Route("event/{id<\d+>}", name="display_event", methods={"GET"})
     */
    public function displayEventCard(Event $event, PerformanceRepository $performanceRepository): Response
    {
        $eventPerfs = $performanceRepository->findBy(['event' => $event], ['date' => 'ASC']);

        return $this->render('front/display_event.html.twig', [
            'pages' => $this->pages,
            'tabs' => $this->tabs,
            'event' => $event,
            'eventPerfs' => $eventPerfs
        ]);
    }
}
