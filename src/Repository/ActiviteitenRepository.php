<?php

namespace App\Repository;

use App\Entity\Activiteiten;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Activiteiten|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activiteiten|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activiteiten[]    findAll()
 * @method Activiteiten[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteitenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activiteiten::class);
    }

    // /**
    //  * @return Activiteiten[] Returns an array of Activiteiten objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Activiteiten
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
