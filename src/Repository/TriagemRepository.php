<?php

namespace App\Repository;

use App\Entity\Pergunta;
use App\Entity\Policial;
use App\Entity\Resposta;
use App\Entity\Telefone;
use App\Entity\Triagem;
use App\Entity\TriagemSituacao;
use App\Helper\PolicialHelper;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\PostgresTypes\InetType;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Tests\DBAL\Types\InetTypeTest;
use JsonSchema\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;

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

    public function createFromRequest(Registry $doctrine, Request $request)
    {
        $data = json_decode($request->getContent(), true);

        /**
         * @var $policial Policial
         */
        $policial = PolicialHelper::criarPolicialPeloRg($doctrine, $data['policial']['rg']);

        if (!($policial instanceof Policial)) {
            throw new \InvalidArgumentException("O rg informado não foi encontrado");
        }

        $triagemSituacao = $this->getEntityManager()->find(
            TriagemSituacao::class,
            TriagemSituacao::REGISTRADA
        );

        $telefone = Telefone::parse($data['policial']['telefone']);

        $triagem = new Triagem();

        if (Telefone::TELEFONE_SMP == $telefone->getTipo() || Telefone::TELEFONE_SMP == $telefone->getTipo()) {
            $triagem->setTelefoneCelular((string)$telefone);
        } else {
            $triagem->setTelefoneFixo((string)$telefone);
        }

        $triagem
            ->setPolicial($policial)
            ->setDtTriagem(new \DateTime('now', new \DateTimeZone('America/Sao_Paulo')))
            ->setIp($request->getClientIp())
            ->setTriagemSituacao($triagemSituacao);

        foreach ($data['respostas'] as $r) {
            /**
             * @var $pergunta Pergunta
             */
            $pergunta = $this->getEntityManager()->find(Pergunta::class, $r['pergunta_id']);

            if ($pergunta instanceof Pergunta) {
                $resposta = new Resposta();
                $resposta->setPergunta($pergunta);
                $resposta->setSelected($selected = isset($r['selected']) ? $r['selected'] : null);
                $resposta->setText($text = isset($r['text']) ? $r['text'] : null);
                $this->getEntityManager()->persist($resposta);
                $triagem->addResposta($resposta);
            }

        }

        return $triagem;

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
