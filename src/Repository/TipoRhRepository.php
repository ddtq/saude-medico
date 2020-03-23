<?php

namespace App\Repository;

use App\Entity\TipoRh;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TipoRh|null find($id, $lockMode = null, $lockVersion = null)
 * @method TipoRh|null findOneBy(array $criteria, array $orderBy = null)
 * @method TipoRh[]    findAll()
 * @method TipoRh[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoRhRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TipoRh::class);
    }

    // /**
    //  * @return TipoRh[] Returns an array of TipoRh objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TipoRh
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
