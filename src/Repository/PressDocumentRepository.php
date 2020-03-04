<?php

namespace App\Repository;

use App\Entity\PressDocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PressDocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method PressDocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method PressDocument[]    findAll()
 * @method PressDocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PressDocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PressDocument::class);
    }

    // /**
    //  * @return PressDocument[] Returns an array of PressDocument objects
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
    public function findOneBySomeField($value): ?PressDocument
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
