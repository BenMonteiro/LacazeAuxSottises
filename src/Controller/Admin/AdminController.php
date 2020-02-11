<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\FrontTabRepository;
use App\Repository\CompanyRepository;
use App\Repository\EventRepository;
use App\Repository\TeamRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    protected $tabList;

    public function __construct(FrontTabRepository $frontTabRepository)
    {
        $this->tabList = $frontTabRepository->findAll();
    }

    /**
     * @Route("/admin/dashboard", name="admin_dashboard", methods={"GET"})
     */
    public function dashboard(
        CompanyRepository $companyRepository,
        TeamRepository $teamRepository,
        EventRepository $eventRepository
    ): Response {
        return $this->render('admin/dashboard.html.twig', [
            'companyNb' => $companyRepository->count([]),
            'teamNb' => $teamRepository->count([]),
            'nextEvent' => $eventRepository->findNextEvent(),
            'tabs' => $this->tabList,
        ]);
    }
}
