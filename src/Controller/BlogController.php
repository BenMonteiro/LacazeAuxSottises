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
    /**
     * @Route("/page/{slug}", name="page_voir", methods={"GET"})
    
    *public function pageVoir(Request $request, Page $page)
    *{
     *   $defaultTemplate = 'default_page.html.twig';

      *  if($page->isCustomTemplate()){
       *     $defaultTemplate = $page->getSlug(). '.html.twig';
        *}

    *    $this->render($defaultTemplate);
    *}
    */
}
