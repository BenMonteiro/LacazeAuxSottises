<?php

namespace App\Controller\Admin;

use App\Entity\FrontTab;
use App\Entity\FrontPage;
use App\Repository\FrontPageRepository;
use App\Controller\Admin\AdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPageController extends AdminController
{
    /**
     * @Route("/admin/tab/{id}", name="admin_tab")
     */
    public function index(
        FrontTab $frontTab,
        FrontPageRepository $frontPageRepository
    ): Response {
        $this->pages = $frontPageRepository->findBy([], ['number' => 'ASC']);

        return $this->render('admin/admin_page/index.html.twig', [
            'tab' => $frontTab,
            'tabs' => $this->tabList,
            'pages' => $this->pages,
        ]);
    }

    /**
     * @Route("/admin/page/{id}", name="page_list_show")
     */
    public function show(FrontPage $frontPage): Response
    {
        return $this->render('admin/admin_page/show.html.twig', [
            'page' => $frontPage,
            'tabs' => $this->tabList,
        ]);
    }
}
