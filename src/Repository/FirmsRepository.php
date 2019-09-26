<?php

namespace App\Repository;

use App\Entity\Firms;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Firms|null find($id, $lockMode = null, $lockVersion = null)
 * @method Firms|null findOneBy(array $criteria, array $orderBy = null)
 * @method Firms[]    findAll()
 * @method Firms[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FirmsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Firms::class);
    }

    // /**
    //  * @return Firms[] Returns an array of Firms objects
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
    public function findOneBySomeField($value): ?Firms
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
