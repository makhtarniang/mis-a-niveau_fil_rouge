<?php

namespace App\Repository;

use App\Entity\GroupeCometance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupeCometance|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeCometance|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeCometance[]    findAll()
 * @method GroupeCometance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeCometanceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeCometance::class);
    }

    // /**
    //  * @return GroupeCometance[] Returns an array of GroupeCometance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupeCometance
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
