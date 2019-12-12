<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog")
     */
    public function index()
    {
        return $this->render('blog/landingPage.html.twig');
    }

     /**
     * @Route("/accueil", name="home")
     */
    public function home()
    {
        return $this->render('blog/home.html.twig');

    }

}
