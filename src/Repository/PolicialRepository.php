<?php

namespace App\Repository;

use App\Entity\Policial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Policial|null find($id, $lockMode = null, $lockVersion = null)
 * @method Policial|null findOneBy(array $criteria, array $orderBy = null)
 * @method Policial[]    findAll()
 * @method Policial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PolicialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Policial::class);
    }

    // /**
    //  * @return Policial[] Returns an array of Policial objects
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
    public function findOneBySomeField($value): ?Policial
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
