<?php

namespace App\Controller;

use App\Entity\FrontPage;
use App\Repository\FrontPageRepository;
use App\Entity\FrontTab;
use App\Repository\FrontTabRepository;
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
        return $this->render('home/landing_page.html.twig');
    }

    /**
     * @Route("/accueil", name="home")
     */
    public function home()
    {
        return $this->render('home/home.html.twig', [
            'tabs' => $this->tabs,
            'pages' => $this->pages,
        ]);
    }

    /**
     * @Route("page/{pageSlug}", name="page_show", requirements={"pageSlug"=".+?"}, methods={"GET"})
     */
    public function displayPage(FrontPage $frontPage): Response
    {
        $defaultTemplate = 'home/association_index.html.twig';

        return $this->render($defaultTemplate, [
            'page' => $frontPage,
            'pages' => $this->pages,
            'tabs' => $this->tabs,
        ]);
    }
}
