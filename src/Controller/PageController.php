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

/**
 * Controller of the front side of the project
 */
class PageController extends AbstractController
{
    protected $pages;
    protected $tabs;

    public function __construct(
        FrontPageRepository $frontPageRepository,
        FrontTabRepository $frontTabRepository
    ) {
        /**
         * Mandatory
         * It appears on the menu 
         */
        $this->pages = $frontPageRepository->findBy([], ['number' => 'ASC']);
        $this->tabs = $frontTabRepository->findBy([], ['number' => 'ASC']);
    }

    /**
     * @Route("/", name="blog")
     * Entry point of the website
     */
    public function index(EventRepository $eventRepository, SectionRepository $sectionRepository, PerformanceRepository $performanceRepository)
    {
        return $this->render('front/landing_page.html.twig', [
            'season' => $eventRepository->findOneBy(['name' => 'saison']),
            'sections' => $sectionRepository->findBy(['belongToPage' => 'home']),
            'homePerfs' => $performanceRepository->findMonthPerfs(),
            'homeEvents' => $eventRepository->findMonthEvents()

        ]);
    }

    /**
     * @Route("page/{pageSlug}", name="page_show", requirements={"pageSlug"=".+?"}, methods={"GET"})
     * This function handle the display of all pages of the website. Some datas are transmitted only in given conditions.Templates are found dynamically.
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

        $homeEvents = ($frontPage->getPageSlug() === 'home') ? $eventRepository->findMonthEvents() : null;
        $homePerfs = ($frontPage->getPageSlug() === 'home') ? $performanceRepository->findMonthPerfs() : null;
        $seasonEvents = ($frontPage->getPageSlug() === 'saison/calendrier') ? $eventRepository->findSeasonEvents() : null;
        $seasonPerformances = ($frontPage->getPageSlug() === 'saison/calendrier') ? $performanceRepository->findBy(['event' => $eventRepository->findBy(['name' => 'saison'])], ['date' => 'ASC']) : null;
        $festPerformances = ($frontPage->getPageSlug() === 'festival/calendrier') ? $performanceRepository->findBy(['event' => $eventRepository->findBy(['name' => 'Festival Fête des sottises !'])], ['date' => 'ASC']) : null;
        $placeEventPerfs = ($frontPage->getPageSlug() === 'tiers-lieu/les-rendez-vous') ? $performanceRepository->findBy(['event' => $eventRepository->findBy(['name' => 'Soirées du Tiers-Lieu'])], ['date' => 'ASC']) : null;
        $partners = ($frontPage->getPageSlug() === 'partenaires/partenaires') ? $partnersRepository->findAll() : null;


        return $this->render($template, [
            'page' => $frontPage,
            'pages' => $this->pages,
            'tabs' => $this->tabs,
            'sections' => $sectionRepository->findBy(['belongToPage' => $frontPage], ['appearanceOrder' => 'ASC']),
            'companies' => $companyRepository->findBy([], ['name' => 'ASC']),
            'season' => $eventRepository->findOneBy(['name' => 'saison']),
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
