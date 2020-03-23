<?php

namespace App\Repository;

use App\Entity\TriagemSituacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TriagemSituacao|null find($id, $lockMode = null, $lockVersion = null)
 * @method TriagemSituacao|null findOneBy(array $criteria, array $orderBy = null)
 * @method TriagemSituacao[]    findAll()
 * @method TriagemSituacao[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TriagemSituacaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TriagemSituacao::class);
    }

    // /**
    //  * @return TriagemSituacao[] Returns an array of TriagemSituacao objects
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
    public function findOneBySomeField($value): ?TriagemSituacao
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
