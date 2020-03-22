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
}