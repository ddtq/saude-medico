<?php

namespace App\Helper;

use App\Entity\Cargo;
use App\Entity\Policial;
use App\Entity\Sexo;
use App\Entity\TipoRh;
use DateTimeInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ManagerRegistry;

abstract class PolicialHelper
{
    public static function verifyPolicial(EntityManager $em, $rg, DateTimeInterface $dataNascimento)
    {
        $check = self::verifyPolicialAtiva($em, $rg, $dataNascimento);

        return $check;
    }

    private static function verifyPolicialAtiva(EntityManager $em, string $rg, DateTimeInterface $dataNascimento)
    {
        $dataNascimento = $dataNascimento->format('Y-m-d');

        $sql = "SELECT * FROM public.pm_cm WHERE rg = '{$rg}' and nascimento = '{$dataNascimento}'";

        $stmt = $em->getConnection()->query($sql);

        if ($stmt->fetch()) {
            $check = true;

        } else {
            $check = null;
        }

        return $check;
    }


    public static function criarPolicialPeloRg(ManagerRegistry $doctrine, $rg)
    {
        $em = $doctrine->getManager();
        $policial = $em->getRepository(Policial::class)->findOneBy([
            "rg" => $rg
        ]);
        if (!($policial instanceof Policial)) {
            $policial = self::findPolicialMeta4($doctrine, $rg);

            // $em->persist($policial);
            // $em->flush();
        }

        return $policial;

    }

    private static function findPolicialMeta4(ManagerRegistry $doctrine, $rg)
    {

        $sql = "SELECT * FROM public.pm_cm WHERE rg = '{$rg}'";

        $stmt = $doctrine->getManager('rh')->getConnection()->query($sql);

        $policial = null;

        if ($result = $stmt->fetch()) {

            $policial = new Policial();

            $em = $doctrine->getManager();

            $cargo = $em->find(Cargo::class, $result['cargo']);
            $tipoRh = $em->find(TipoRh::class, TipoRh::ATIVA);
            $sexo = $em->find(Sexo::class, strtoupper($result['sexo']));

            $policial
                ->setRg($rg)
                ->setNome($result['nome'])
                ->setDataNascimento(new \DateTime($result['nascimento'], new \DateTimeZone('America/Sao_Paulo')))
                ->setQuadro($result['quadro'])
                ->setSubquadro($result['subquadro'])
                ->setOpmMeta4Id('')
                ->setOpmNome('')
                ->setOpmAbrev('')
                ->setCreatedAt(new \DateTime())
                ->setTipoRh($tipoRh)
                ->setCargo($cargo)
                ->setSexo($sexo)
                ->setMunicipio($result['cidade']);

            $em->persist($policial);

            $em->flush();

        }

        return $policial;
    }


}