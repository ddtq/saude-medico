<?php

namespace App\Repository;

use App\Entity\Triagem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Triagem|null find($id, $lockMode = null, $lockVersion = null)
 * @method Triagem|null findOneBy(array $criteria, array $orderBy = null)
 * @method Triagem[]    findAll()
 * @method Triagem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TriagemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Triagem::class);
    }

    // /**
    //  * @return Triagem[] Returns an array of Triagem objects
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
    public function findOneBySomeField($value): ?Triagem
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
