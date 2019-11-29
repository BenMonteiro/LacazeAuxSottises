<?php

namespace App\Repository;

use App\Entity\Cies;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cies|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cies|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cies[]    findAll()
 * @method Cies[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cies::class);
    }

    // /**
    //  * @return Cies[] Returns an array of Cies objects
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
    public function findOneBySomeField($value): ?Cies
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
