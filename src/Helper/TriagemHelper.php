<?php


namespace App\Helper;


use App\Entity\Pergunta;
use App\Entity\ResultadoTriagem;
use App\Entity\Triagem;

class TriagemHelper
{

    const DOCUMENTO_DE_ORIGEM="https://portalarquivos2.saude.gov.br/images/pdf/2020/marco/04/2020-03-02-Boletim-Epidemiol--gico-04-corrigido.pdf";

    public static function analisar(Triagem $triagem): string
    {

        // Caso Suspeito ou provável
        // (Febre) && (tosse || dificuldade para respirar || congestão nasal || ... )

        $febre = false;

        $outros = 0;

        $resultado = ResultadoTriagem::CASO_NAO_SE_ENQUADRA;

        foreach ($triagem->getRespostas() as $resposta) {
            if(is_null($resposta->getSelected()) || false === $resposta->getSelected()) {
                continue;
            }
            /**
             * @var $pergunta Pergunta
             */
            $pergunta = $resposta->getPergunta();

            if (
                false !== strpos('febre', strtolower($pergunta->getPergunta()))
            ) {
                $febre = true;
            } else {
                $outros++;
            }

        }

        if (($febre && $outros > 0) || ($outros > 1)) {
            $resultado = ResultadoTriagem::CASO_SUSPEITO_OU_PROVAVEL;
        }

        return $resultado;

    }

}