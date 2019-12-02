<?php

namespace App\Repository;

use App\Entity\CieDates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CieDates|null find($id, $lockMode = null, $lockVersion = null)
 * @method CieDates|null findOneBy(array $criteria, array $orderBy = null)
 * @method CieDates[]    findAll()
 * @method CieDates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CieDatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CieDates::class);
    }

    // /**
    //  * @return CieDates[] Returns an array of CieDates objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CieDates
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
