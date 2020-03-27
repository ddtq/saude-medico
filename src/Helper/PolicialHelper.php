<?php

namespace App\Helper;

use App\Entity\Policial;

abstract class PolicialHelper
{
    public static function verifyPolicial($em, $rg, \Datetime $dataNascimento)
    {
        $dataNascimento = $dataNascimento->format('Y-m-d');

        $check = self::verifyPolicialAtiva($em, $rg, $dataNascimento);

        return $check;
    }

    private static function verifyPolicialAtiva($em, $rg, $dataNascimento)
    {
        $sql = "SELECT * FROM public.pm_cm WHERE rg = '{$rg}' and nascimento = '{$dataNascimento}'";

        $stmt = $em->getConnection()->query($sql);
        
        if($stmt->fetch()){
            $check = true;
            
        } else {
            $check = null;
        }

        return $check;
    }


    public static function criarPolicialPeloRg($doctrine, $rg){
        $em = $doctrine->getManager();
        $policial = $em->getRepository(Policial::class)->findOneBy([
            "rg"=>$rg
        ]);
        if(!($policial instanceof Policial)){
            $policial = self::findPolicialMeta4($doctrine->getManager('rh'), $rg);
             
            // $em->persist($policial);
            // $em->flush();
        }

        return $policial;

    }

    private static function findPolicialMeta4($em, $rg){

        $sql = "SELECT * FROM public.pm_cm WHERE rg = '{$rg}'";

        $stmt = $em->getConnection()->query($sql);
        
        $policial = null;

        if($result = $stmt->fetch()){
            $policial = new Policial();
            $policial->setRg($rg);    
            $policial->setNome($result['nome']); 
        }
        return $policial;
    }


}