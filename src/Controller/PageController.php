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
    protected $eventRepository;
    protected $performanceRepository;
    protected $companyRepository;
    protected $partnersRepository;
    protected $sectionRepository;
    protected $frontPage;
    protected $pages;
    protected $tabs;

    public function __construct(
        FrontPageRepository $frontPageRepository,
        FrontTabRepository $frontTabRepository,
        EventRepository $eventRepository,
        PerformanceRepository $performanceRepository,
        CompanyRepository $companyRepository,
        PartnersRepository $partnersRepository,
        SectionRepository $sectionRepository
    ) {
        /**
         * Mandatory
         * It appears on the menu 
         */
        $this->pages = $frontPageRepository->findBy([], ['number' => 'ASC']);
        $this->tabs = $frontTabRepository->findBy([], ['number' => 'ASC']);

        $this->eventRepository = $eventRepository;
        $this->performanceRepository = $performanceRepository;
        $this->companyRepository = $companyRepository;
        $this->partnersRepository = $partnersRepository;
        $this->sectionRepository = $sectionRepository;
    }

    /**
     * @Route("/", name="blog")
     * Entry point of the website
     */
    public function index(SectionRepository $sectionRepository)
    {
        return $this->render('front/landing_page.html.twig', [
            'season' => $this->eventRepository->findOneBy(['name' => 'saison']),
            'sections' => $sectionRepository->findBy(['belongToPage' => 'home']),
            'homePerfs' => $this->performanceRepository->findMonthPerfs(),
            'homeEvents' => $this->eventRepository->findMonthEvents()

        ]);
    }

    /**
     * @Route("page/{pageSlug}", name="page_show", requirements={"pageSlug"=".+?"}, methods={"GET"})
     * This function handle the display of all pages of the website.Templates are found dynamically.
     */
    public function displayPage(
        FrontPage $frontPage
    ): Response {

        $page = $frontPage->getPageSlug();

        $pageFolder = $frontPage->getTab();
        $pageTemplate = $frontPage->getTemplate();
        $defaultTemplate = 'front/page_default.html.twig';

        $template = (empty($pageTemplate)) ? $defaultTemplate : 'front/' . $pageFolder . '/' . $pageTemplate . '.html.twig';

        $data = [
            'page' => $frontPage,
            'pages' => $this->pages,
            'tabs' => $this->tabs,
            'sections' => $this->sectionRepository->findBy(['belongToPage' => $frontPage], ['appearanceOrder' => 'ASC']),
            'season' => $this->eventRepository->findOneBy(['name' => 'saison']),
        ];

        $data = $this->completeViewData($page, $data);

        return $this->render($template, $data);
    }

    /**
     *  This function handle the datas to transmit to the views
     */
    public function completeViewData($page, $data)
    {
        switch ($page) {
            case 'home':
                $data['homeEvents'] = $this->eventRepository->findMonthEvents();
                $data['homePerfs'] = $this->performanceRepository->findMonthPerfs();
                break;
            case 'saison/calendrier':
                $data['seasonEvents'] = $this->eventRepository->findSeasonEvents();
                $data['seasonPerfs'] = $this->performanceRepository->findBy(['event' => $this->eventRepository->findBy(['name' => 'saison'])], ['date' => 'ASC']);
                break;
            case 'festival/calendrier':
                $data['festPerfs'] = $this->performanceRepository->findBy(['event' => $this->eventRepository->findBy(['name' => 'Festival Fête des sottises !'])], ['date' => 'ASC']);
                break;
            case 'tiers-lieu/les-rendez-vous':
                $data['placeEventPerfs'] = $this->performanceRepository->findBy(['event' => $this->eventRepository->findBy(['name' => 'Soirées du Tiers-Lieu'])], ['date' => 'ASC']);
                break;
            case 'partenaires/partenaires':
                $data['partners'] = $this->partnersRepository->findAll();
                break;
            case 'season/hostedCompanies':
                $data['companies'] = $this->companyRepository->findBy([], ['name' => 'ASC']);
                break;
        }

        return $data;
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
    public function displayEventCard(Event $event): Response
    {
        $eventPerfs = $this->performanceRepository->findBy(['event' => $event], ['date' => 'ASC']);

        return $this->render('front/display_event.html.twig', [
            'pages' => $this->pages,
            'tabs' => $this->tabs,
            'event' => $event,
            'eventPerfs' => $eventPerfs
        ]);
    }
}
