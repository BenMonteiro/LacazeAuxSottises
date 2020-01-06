<?php

namespace App\Controller;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use App\Entity\Team;
use App\Repository\TeamRepository;
use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(CompanyRepository $companyRepository, TeamRepository $teamRepository, EventRepository $eventRepository)
    {
        return $this->render('admin/dashboard.html.twig', [
            'controller_name' => 'AdminController',
            'companyNb' => $companyRepository->count(),
            'companyInDiffusionNb' => $companyRepository->countBy(['isInDiffusion' => 1]),
            'teamNb' => $teamRepository->count(),
            'nextEvent' => $eventRepository->findNextEvent()
        ]);
    }
}
