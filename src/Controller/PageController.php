<?php

namespace App\Controller;

use App\Entity\FrontPage;
use App\Repository\FrontPageRepository;
use App\Repository\FrontTabRepository;
use App\Repository\SectionRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    protected $pages;
    protected $page;
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
    public function displayPage(FrontPage $frontPage, SectionRepository $sectionRepository): Response
    {
        $pageFolder = $frontPage->getTab();
        $pageTemplate = $frontPage->getTemplate();
        $defaultTemplate = 'front/page_default.html.twig';

        $template = ($pageTemplate === null) ? $defaultTemplate : 'front/' . $pageFolder . '/' . $pageTemplate . '.html.twig';

        return $this->render($template, [
            'page' => $frontPage,
            'pages' => $this->pages,
            'tabs' => $this->tabs,
            'sections' => $sectionRepository->findBy(['belongToPage' => $frontPage], ['appearanceOrder' => 'ASC'])
        ]);
    }
}
