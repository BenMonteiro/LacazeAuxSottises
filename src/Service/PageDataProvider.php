<?php

namespace App\Service;

use App\Repository\FrontPageRepository;
use App\Repository\FrontTabRepository;
use App\Repository\SectionRepository;
use App\Repository\EventRepository;
use App\Repository\PerformanceRepository;
use App\Repository\CompanyRepository;
use App\Repository\PartnersRepository;

class PageDataProvider
{
    protected $eventRepository;
    protected $performanceRepository;
    protected $companyRepository;
    protected $partnersRepository;
    protected $sectionRepository;
    protected $frontPage;
    protected $pages;
    protected $tabs;

    public function __construct(
        EventRepository $eventRepository,
        PerformanceRepository $performanceRepository,
        CompanyRepository $companyRepository,
        PartnersRepository $partnersRepository,
        SectionRepository $sectionRepository,
        FrontPageRepository $frontPageRepository,
        FrontTabRepository $frontTabRepository
    ) {
        $this->eventRepository = $eventRepository;
        $this->performanceRepository = $performanceRepository;
        $this->companyRepository = $companyRepository;
        $this->partnersRepository = $partnersRepository;
        $this->sectionRepository = $sectionRepository;
        $this->pages = $frontPageRepository->findBy([], ['number' => 'ASC']);
        $this->tabs = $frontTabRepository->findBy([], ['number' => 'ASC']);
    }

    public function pageData($page, $frontPage)
    {
        $data = [
            'page' => $frontPage,
            'pages' => $this->pages,
            'tabs' => $this->tabs,
            'sections' => $this->sectionRepository->findBy(['belongToPage' => $frontPage, 'isHidden' => false], ['appearanceOrder' => 'ASC']),
            'season' => $this->eventRepository->findOneBy(['name' => 'saison']),
        ];

        $data = $this->completeViewData($page, $data);
        return $data;
    }

    /**
     *  This function handle the datas to transmit to the views
     */
    private function completeViewData($page, $data)
    {
        switch ($page) {
            case 'accueil':
                $data['homeEvents'] = $this->eventRepository->findMonthEvents();
                $data['homePerfs'] = $this->performanceRepository->findMonthPerfs();
                $data['placeEventPerfs'] = $this->performanceRepository->findBy(['event' => $this->eventRepository->findBy(['name' => 'Soirées du Tiers-Lieu'])], ['date' => 'ASC']);
                break;
            case 'agenda':
                $data['performances'] = $this->performanceRepository->agendaPerfs();
                break;
            case 'saison/calendrier':
                $data['seasonMonths'] = $this->performanceRepository->findSeasonMonth();
                $data['performances'] = $this->performanceRepository->seasonPerfs();
                break;
            case 'saison/cies-accueillies':
                $data['perfs'] = $this->performanceRepository->findBy(['company' => $this->companyRepository->findBy(['isHidden' => false])], ['date' => 'ASC']);
                break;
            case 'festival/calendrier':
                $data['festDates'] = $this->performanceRepository->festDates();
                $data['festPrelude'] = $this->performanceRepository->findBy(['event' => $this->eventRepository->findBy(['name' => 'Préambules sur le territoire'])], ['date' => 'ASC']);
                $data['festPerfs'] = $this->performanceRepository->findBy(['event' => $this->eventRepository->findBy(['name' => 'Festival Fête des sottises !'])], ['date' => 'ASC']);
                break;
            case 'festival/cies-accueillies':
                $data['companies'] = $this->companyRepository->findFestCompanies();;
                break;
            case 'tiers-lieu/soirees-du-tiers-lieu':
                $data['placeEventPerfs'] = $this->performanceRepository->findBy(['event' => $this->eventRepository->findBy(['name' => 'Soirées du Tiers-Lieu'])], ['date' => 'ASC']);
                break;
            case 'soutient':
                $data['partners'] = $this->partnersRepository->findAll();
                break;
        }

        return $data;
    }
}
