<?php

namespace App\Repository;

use App\Entity\Iep;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Iep|null find($id, $lockMode = null, $lockVersion = null)
 * @method Iep|null findOneBy(array $criteria, array $orderBy = null)
 * @method Iep[]    findAll()
 * @method Iep[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IepRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Iep::class);
    }

    // /**
    //  * @return Iep[] Returns an array of Iep objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Iep
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
