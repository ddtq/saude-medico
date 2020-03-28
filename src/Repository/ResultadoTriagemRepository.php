<?php

namespace App\Repository;

use App\Entity\ResultadoTriagem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ResultadoTriagem|null find($id, $lockMode = null, $lockVersion = null)
 * @method ResultadoTriagem|null findOneBy(array $criteria, array $orderBy = null)
 * @method ResultadoTriagem[]    findAll()
 * @method ResultadoTriagem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResultadoTriagemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ResultadoTriagem::class);
    }

    // /**
    //  * @return ResultadoTriagem[] Returns an array of ResultadoTriagem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ResultadoTriagem
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
