<?php

namespace App\Controller;

use App\Entity\FrontPage;
use App\Repository\FrontPageRepository;
use App\Repository\FrontTabRepository;
use App\Repository\SectionRepository;
use App\Repository\EventRepository;
use App\Repository\PerformanceRepository;
use App\Repository\CompanyRepository;
use App\Entity\Company;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    protected $pages;
    protected $tabs;

    public function __construct(FrontPageRepository $frontPageRepository, FrontTabRepository $frontTabRepository)
    {
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
    public function displayPage(FrontPage $frontPage, SectionRepository $sectionRepository, EventRepository $eventRepository, PerformanceRepository $performanceRepository, CompanyRepository $companyRepository): Response
    {
        $pageFolder = $frontPage->getTab();
        $pageTemplate = $frontPage->getTemplate();
        $defaultTemplate = 'front/page_default.html.twig';

        $template = (empty($pageTemplate)) ? $defaultTemplate : 'front/' . $pageFolder . '/' . $pageTemplate . '.html.twig';

        if ($frontPage->getPageSlug() === 'saison/calendrier') {

            $seasonEvents = $eventRepository->findSeasonEvents();
            $seasonPerformances = $performanceRepository->findBy(['event' => 29], ['date' => 'ASC']);

            return $this->render($template, [
                'page' => $frontPage,
                'pages' => $this->pages,
                'tabs' => $this->tabs,
                'sections' => $sectionRepository->findBy(['belongToPage' => $frontPage], ['appearanceOrder' => 'ASC']),
                'events' => $seasonEvents,
                'perfs' => $seasonPerformances
            ]);
        } elseif ($pageTemplate === 'calendar' and $pageFolder === 'festival') {

            $festPerformances = $performanceRepository->findBy(['event' => 'festival'], ['date' => 'ASC']);

            return $this->render($template, [
                'page' => $frontPage,
                'pages' => $this->pages,
                'tabs' => $this->tabs,
                'sections' => $sectionRepository->findBy(['belongToPage' => $frontPage], ['appearanceOrder' => 'ASC']),
                'perfs' => $festPerformances
            ]);
        } else {
            return $this->render($template, [
                'page' => $frontPage,
                'pages' => $this->pages,
                'tabs' => $this->tabs,
                'sections' => $sectionRepository->findBy(['belongToPage' => $frontPage], ['appearanceOrder' => 'ASC']),
                'companies' => $companyRepository->findBy([], ['name' => 'ASC']),
            ]);
        }
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
}
