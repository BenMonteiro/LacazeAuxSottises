<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("/landingPage", name="pages")
     */
    public function index()
    {
        return $this->render('pages/landingPage.html.twig', [
            'controller_name' => 'PagesController',
        ]);
    }

     /**
     * @Route("/accueil", name="home")
     */
    public function home()
    {
        return $this->render('pages/home.html.twig');

    }

}
