<?php

namespace App\Repository;

use App\Entity\Performance;
use App\Repository\EventRepository;
use App\Repository\CompanyRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Performance|null find($id, $lockMode = null, $lockVersion = null)
 * @method Performance|null findOneBy(array $criteria, array $orderBy = null)
 * @method Performance[]    findAll()
 * @method Performance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformanceRepository extends ServiceEntityRepository
{
    protected $eventRepository;
    protected $companyRepository;

    public function __construct(ManagerRegistry $registry, EventRepository $eventRepository, CompanyRepository $companyRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->companyRepository = $companyRepository;
        parent::__construct($registry, Performance::class);
    }

    public function findMonthPerfs()
    {
        return $this->createQueryBuilder('perf')
            ->andWhere('month(perf.date) = month(now())')
            ->andWhere('perf.isHighlight = true')
            ->orderBy('perf.date', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function seasonPerfs()
    {
        $performances = $this->findBy([], ['date' => 'ASC']);
        $seasonPerfs = [];
        $perfEvents = [];

        foreach ($performances as $perf) {
            if ($perf->getEvent() == 'saison') {
                array_push($seasonPerfs, $perf);
            } elseif ($perf->getEvent() != 'saison') {
                array_push($perfEvents, $perf);
            }
        };

        $perfUniqueEvents =  array_unique($perfEvents);
        $perfs =  array_merge($seasonPerfs, $perfUniqueEvents);

        asort($perfs);

        return $perfs;
    }

    public function festDates()
    {
        $dates = $this->findBy(['event' => $this->eventRepository->findBy(['name' => 'Festival Fête des sottises !'])], ['date' => 'ASC']);

        $festDates = [];

        foreach ($dates as $date) {
            $date = $date->getDate();
            $festDate = date_format($date, 'D d M Y');

            array_push($festDates, $festDate);
        }

        $uniqueDates = array_unique($festDates);

        return $uniqueDates;
    }
    // /**
    //  * @return Performance[] Returns an array of Performance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Performance
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
