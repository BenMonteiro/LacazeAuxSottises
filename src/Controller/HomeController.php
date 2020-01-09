<?php

namespace App\Controller;

use App\Entity\FrontPage;
use App\Repository\FrontPageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
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
     * @Route("/{pageSlug}", name="show_page", requirements={"pageSlug"=".+"}, methods={"GET"})
     */
    public function showPage(FrontPage $frontPage): Response
    {
        $defaultTemplate = 'home/association_index.html.twig';

        return $this->render($defaultTemplate, [
            'page' => $frontPage,
            'pages' => $this->pages
        ]);
    }
}
