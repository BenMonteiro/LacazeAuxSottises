<?php

namespace App\Controller;

use App\Entity\FrontPage;
use App\Repository\FrontPageRepository;
use App\Repository\FrontTabRepository;
use App\Repository\SectionRepository;
use App\Entity\Event;
use App\Entity\Company;
use App\Repository\EventRepository;
use App\Repository\PerformanceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PageDataProvider;

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
    public function index(SectionRepository $sectionRepository, EventRepository $eventRepository, PerformanceRepository $performanceRepository)
    {
        return $this->render('front_pages/landing_page.html.twig', [
            'season' => $eventRepository->findOneBy(['name' => 'saison']),
            'sections' => $sectionRepository->findBy(['belongToPage' => 'home']),
            'homePerfs' => $performanceRepository->findMonthPerfs(),
            'homeEvents' => $eventRepository->findMonthEvents()

        ]);
    }

    /**
     * @Route("page/{pageSlug}", name="page_show", requirements={"pageSlug"=".+?"}, methods={"GET"})
     * This function handle the display of all pages of the website.Templates are found dynamically.
     */
    public function displayPage(
        FrontPage $frontPage,
        PageDataProvider $pageData
    ): Response {

        $page = $frontPage->getPageSlug();

        $pageFolder = $frontPage->getTab();
        $pageTemplate = $frontPage->getTemplate();
        $defaultTemplate = 'front_pages/page_default.html.twig';

        $template = (empty($pageTemplate)) ? $defaultTemplate : 'front_pages/' . $pageFolder . '/' . $pageTemplate . '.html.twig';

        $data = $pageData->pageData($page, $frontPage);

        return $this->render($template, $data);
    }

    /**
     * @Route("company/{id<\d+>}", name="display_company", methods={"GET"})
     */
    public function displayCompanyCard(Company $company): Response
    {
        return $this->render('front_pages/display_company_card.html.twig', [
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

        return $this->render('front_pages/display_event_card.html.twig', [
            'pages' => $this->pages,
            'tabs' => $this->tabs,
            'event' => $event,
        ]);
    }
}
