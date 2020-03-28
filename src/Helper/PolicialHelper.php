<?php

namespace App\Helper;

use App\Entity\Cargo;
use App\Entity\Policial;
use App\Entity\Sexo;
use App\Entity\TipoRh;
use DateTime;
use DateTimeInterface;
use DateTimeZone;
use Doctrine\DBAL\DBALException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Exception;

abstract class PolicialHelper
{
    public static function verifyPolicial(ObjectManager $em, $rg, DateTimeInterface $dataNascimento)
    {
        $check = self::verifyPolicialAtiva($em, $rg, $dataNascimento);

        return $check;
    }

    private static function verifyPolicialAtiva(ObjectManager $em, string $rg, DateTimeInterface $dataNascimento)
    {
        $dataNascimento = $dataNascimento->format('Y-m-d');

        $sql = 'SELECT * FROM public.pm_cm WHERE rg = :rg and nascimento = :data_nascimento';

        try {

            $stmt = $em->getConnection()->prepare($sql);

            $stmt->bindParam('rg', $rg);
            $stmt->bindParam('data_nascimento', $dataNascimento);

            $stmt->execute();

        } catch (DBALException $e) {

            throw new Exception('Erro na conexão com o banco de dados.');

        }

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

            $em->persist($policial);
            $em->flush();
        } else {

            $policial = self::atualizaPolicial($doctrine, $policial);

        }

        return $policial;

    }

    private static function executeQueryPolicialMeta4(ManagerRegistry $doctrine, $rg)
    {

        $sql = "SELECT pm_cm.*, opmpmpr.abreviatura FROM public.pm_cm

                LEFT JOIN opmpmpr ON pm_cm.opm_meta4 = opmpmpr.meta4

                WHERE rg = :rg";

        $stmt = $doctrine->getManager('rh')->getConnection()->prepare($sql);

        $stmt->bindParam('rg', $rg);

        $stmt->execute();

        $policial = null;

        if ($result = $stmt->fetch()) {
            return $result;
        }

        return null;

    }

    private static function findPolicialMeta4(ManagerRegistry $doctrine, $rg)
    {

        $result = self::executeQueryPolicialMeta4($doctrine, $rg);

        if ($result) {

            $policial = new Policial();

            $em = $doctrine->getManager();

            $cargo = $em->find(Cargo::class, $result['cargo']);
            $tipoRh = $em->find(TipoRh::class, TipoRh::ATIVA);
            $sexo = $em->find(Sexo::class, strtoupper($result['sexo']));

            $policial
                ->setRg($rg)
                ->setNome($result['nome'])
                ->setDataNascimento(new DateTime($result['nascimento'], new DateTimeZone('America/Sao_Paulo')))
                ->setQuadro($result['quadro'])
                ->setSubquadro($result['subquadro'])
                ->setOpmMeta4Id($result['opm_meta4'])
                ->setOpmNome($result['opm_descricao'])
                ->setOpmAbrev($result['abreviatura'])
                ->setCreatedAt(new DateTime())
                ->setTipoRh($tipoRh)
                ->setCargo($cargo)
                ->setSexo($sexo)
                ->setMunicipio($result['cidade']);

        }

        return $policial;
    }

    private static function atualizaPolicial(ManagerRegistry $doctrine, Policial $policial)
    {
        $result = self::executeQueryPolicialMeta4($doctrine, $policial->getRg());

        if ($result) {

            $em = $doctrine->getManager();

            $cargo = $em->getRepository(Cargo::class)->find($result['cargo']);
            $tipoRh = $em->getRepository(TipoRh::class)->find(TipoRh::ATIVA);
            $sexo = $em->getRepository(Sexo::class)->find(strtoupper($result['sexo']));

            $policial
                ->setNome($result['nome'])
                ->setDataNascimento(new DateTime($result['nascimento'], new DateTimeZone('America/Sao_Paulo')))
                ->setQuadro($result['quadro'])
                ->setSubquadro($result['subquadro'])
                ->setOpmMeta4Id($result['opm_meta4'])
                ->setOpmNome($result['opm_descricao'])
                ->setOpmAbrev($result['abreviatura'])
                ->setCreatedAt(new DateTime())
                ->setTipoRh($tipoRh)
                ->setCargo($cargo)
                ->setSexo($sexo)
                ->setMunicipio($result['cidade']);

        }

        return $policial;
    }

}