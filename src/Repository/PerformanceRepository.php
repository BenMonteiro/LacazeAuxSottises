<?php

namespace App\Repository;

use App\Entity\Performance;
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
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Performance::class);
    }

    public function findMonthPerf()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * 
        FROM performance
        WHERE MONTH(date)  = MONTH(NOW())
        AND is_highlight = true
        ORDER BY date ASC
            ';

        return $conn->query($sql)->fetchAll();
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
