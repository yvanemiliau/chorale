<?php

namespace App\Repository;

use App\Entity\Voix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Voix|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voix|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voix[]    findAll()
 * @method Voix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voix::class);
    }

    // /**
    //  * @return Voix[] Returns an array of Voix objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Voix
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
