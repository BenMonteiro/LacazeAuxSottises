<?php

namespace App\Controller;

use App\Entity\FrontTab;
use App\Entity\FrontPage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPageController extends AbstractController
{

    /**
     * @Route("/admin/tab/{id}", name="admin_tab")
     */
    public function index(FrontTab $frontTab): Response
    {
        return $this->render('admin_page/index.html.twig', [
            'tab' => $frontTab,
        ]);
    }

    /**
     * @Route("/admin/page/{id}", name="page_show")
     */
    public function show(FrontPage $frontPage): Response
    {
        return $this->render('admin_page/show.html.twig', [
            'page' => $frontPage,
        ]);
    }
}
