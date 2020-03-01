<?php

namespace App\Repository;

use App\Entity\Event;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
     * Find the next event to come up
     */
    public function findNextEvent()
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT * 
        FROM event
        WHERE starting_date > NOW()
        ORDER BY starting_date ASC
        LIMIT 1
            ';

        return $conn->query($sql)->fetch();
    }


    public function findMonthEvents()
    {
        return $this->createQueryBuilder('event')
            ->andWhere('month(event.startingDate) = month(now())')
            ->andWhere('event.isHighlight = true')
            ->orderBy('event.startingDate', 'ASC')
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return Event[] Returns an array of Event objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
