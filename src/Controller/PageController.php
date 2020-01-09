<?php

namespace App\Controller;

use App\Entity\FrontPage; 
use App\Repository\FrontPageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{

    protected $pages;
    protected $page;

    public function __construct(FrontPageRepository $frontPageRepository)
    {
        $this->pages = $frontPageRepository->findAll();
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
            'pages' => $this->pages
        ]);
    }
}
