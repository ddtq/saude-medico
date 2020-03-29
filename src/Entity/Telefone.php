<?php

namespace App\Entity;

use phpDocumentor\Reflection\Types\Self_;

class Telefone
{
    public const TELEFONE_SMP="SMP"; // Serviço Móvel Pessoal
    public const TELEFONE_STFC="STFC"; // Serviço Telefônico Fixo Comutado
    public const TELEFONE_SME="SME"; // Serviço Móvel Especializado

    private $codigoDoPais;
    private $codigoDeArea;
    private $numeroDoAssinante;
    private $tipo;
    private $telefone;

    private function __construct(string $telefone)
    {
        $this->telefone = preg_replace('/[^0-9]/', '',$telefone);
    }

    public static function parse(string $telefone): self
    {

        $t = new self($telefone);

        if (strlen($t->telefone) > 13 || strlen($t->telefone) < 8) {

            $t->numeroDoAssinante = $t->telefone;
            $t->telefone = "";

        }

        self::numeroDoAssinante($t);

        if (strlen($t->telefone) <= 13) {
            self::codigoDoPais($t);
        }

        if (strlen($t->telefone) === 12 || strlen($t->telefone) === 13) {
            $t->codigoDeArea = substr($t->telefone, 2, 2);
        }

        if (strlen($t->telefone) === 10 || strlen($t->telefone) === 11) {
            $t->codigoDeArea = substr($t->telefone, 0, 2);
        }

        return $t;

    }

    private static function codigoDoPais(Telefone $telefone)
    {
        if (strlen($telefone->telefone) >=12) {
            $telefone->codigoDoPais = substr($telefone->telefone, 0, 2);
        }
    }

    private static function numeroDoAssinante(Telefone $telefone)
    {
        if (strlen($telefone->telefone) <=13 && strlen($telefone->telefone) >= 8 && strlen($telefone->telefone) % 2 === 0) {

            $ultimosOitoDigitos = substr($telefone->telefone, -8, 8);

            $telefone->numeroDoAssinante = $ultimosOitoDigitos;

            $primeiroDigito = substr($ultimosOitoDigitos,0,1);

            // ou é smp faltando o 9
            if (in_array($primeiroDigito, ['8','9'])) {
                $telefone->tipo = Telefone::TELEFONE_SMP;
            } elseif (in_array($primeiroDigito, ['2','3','4','5'])) {
                $telefone->tipo = self::TELEFONE_STFC;
            } elseif (in_array($primeiroDigito, ['7'])) {
                $telefone->tipo = self::TELEFONE_SME;
            } else {
                $telefone->numeroDoAssinante = $telefone->telefone;
                $telefone->telefone = "";
            }

        } elseif (strlen($telefone->telefone) <=13 && strlen($telefone->telefone) >= 8 && strlen($telefone->telefone) % 2 !== 0) {

            $ultimosNoveDigitos = substr($telefone->telefone, -9, 9);

            $telefone->numeroDoAssinante = $ultimosNoveDigitos;

            $primeiroDigito = substr($ultimosNoveDigitos,0,1);

            // ou é smp
            if (in_array($primeiroDigito, ['9'])) {
                $telefone->tipo = Telefone::TELEFONE_SMP;
            } else {
                $telefone->numeroDoAssinante = $telefone->telefone;
                $telefone->telefone = "";
            }

        }

    }

    /**
     * @return mixed
     */
    public function getCodigoDoPais()
    {
        return $this->codigoDoPais;
    }

    /**
     * @return mixed
     */
    public function getCodigoDeArea()
    {
        return $this->codigoDeArea;
    }

    /**
     * @return mixed
     */
    public function getNumeroDoAssinante()
    {
        return $this->numeroDoAssinante;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    public function __toString()
    {
        if (Telefone::TELEFONE_STFC === $this->getTipo() || is_null($tipo = $this->getTipo()) ) {
            return $this->getCodigoDoPais() . $this->getCodigoDeArea() . $this->getNumeroDoAssinante();
        }

        if (is_null($codigoDoPais = $this->getCodigoDoPais())) {
            $codigoDoPais = '55';
        } else {
            $codigoDoPais = $this->getCodigoDoPais();
        }

        if (is_null($codigoDeArea = $this->getCodigoDeArea())) {
            $codigoDeArea = '41';
        } else {
            $codigoDeArea = $this->getCodigoDeArea();
        }

        return '+' . $codigoDoPais . $codigoDeArea . $this->getNumeroDoAssinante();
    }


}