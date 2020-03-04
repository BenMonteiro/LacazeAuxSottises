<?php

namespace App\Repository;

use App\Entity\FrontTab;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FrontTab|null find($id, $lockMode = null, $lockVersion = null)
 * @method FrontTab|null findOneBy(array $criteria, array $orderBy = null)
 * @method FrontTab[]    findAll()
 * @method FrontTab[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrontTabRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FrontTab::class);
    }

    // /**
    //  * @return FrontTab[] Returns an array of FrontTab objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FrontTab
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
