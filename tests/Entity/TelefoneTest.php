<?php

namespace App\Tests\Entity;

use App\Entity\Telefone;
use PHPUnit\Framework\TestCase;

class TelefoneTest extends TestCase
{
    public function testParseDeveRetornarTelefone()
    {
        $telefone = Telefone::parse('5541980000000');

        $this->assertInstanceOf(Telefone::class, $telefone, "Não retornou objeto Telefone");

    }

    public function testTelefoneComMaisde13OuMenosDe8digitosDevemSerArmazenadosEmNumeroDoAssinante()
    {
        $numeroComMaisDeTrezeDigitos = '12345678901234';

        $telefone = Telefone::parse($numeroComMaisDeTrezeDigitos);

        $this->assertEquals(
            $numeroComMaisDeTrezeDigitos,
            $telefone->getNumeroDoAssinante(),
            "Telefone com mais de 13 digitos não está sendo armazenado corretamente em número do assinante"
        );

        $numeroComMenosDeOitoDigitos = '1234567';

        $telefone = Telefone::parse($numeroComMenosDeOitoDigitos);

        $this->assertEquals(
            $numeroComMenosDeOitoDigitos,
            $telefone->getNumeroDoAssinante(),
            "Telefone com menos de 8 digitos não está sendo armazenado corretamente em número do assinante"
        );
    }

    public function testTelefoneCom13e12DigitosDeveTerCodigoDoPais()
    {
        $telefone1 = Telefone::parse('5541980000000');

        $this->assertEquals(
            '55',
            $telefone1->getCodigoDoPais(),
            sprintf("Não retornou o codigo do pais corretamente para o telefone: %s ", '5541980000000')
        );

        $telefone2 = Telefone::parse('554132100000');

        $this->assertEquals(
            '55',
            $telefone2->getCodigoDoPais(),
            sprintf("Não retornou o codigo do pais corretamente para o telefone: %s ", '5541321000000')
        );
    }

    // 8 digitos pode ser fixo(STFC) ou radio (SME) ou smp
    public function testTelefoneCom8DigitosDeveSerClassificadoCorretamente()
    {
        $fixos = ["23456789", "34567890", "45678901", "56789012"];
        $radios = ["70000000", "78901234"];
        $smps = ["84000000","91000000"];

        foreach ($fixos as $fixo) {
            $telefone = Telefone::parse($fixo);
            $this->assertEquals($fixo, $telefone->getNumeroDoAssinante(), sprintf("Telefone: %s não foi registrado corretamente em NumeroDoAssinante", $fixo));
            $this->assertEquals(
                Telefone::TELEFONE_STFC,
                $telefone->getTipo(),
                sprintf("Telefone: %s não foi registrado corretamente como STFC", $fixo)
            );
        }

        foreach ($radios as $radio) {
            $telefone = Telefone::parse($radio);
            $this->assertEquals($radio, $telefone->getNumeroDoAssinante(),sprintf("Telefone: %s não foi registrado corretamente em NumeroDoAssinante", $radio));
            $this->assertEquals(
                Telefone::TELEFONE_SME,
                $telefone->getTipo(),
                sprintf("Telefone: %s não foi registrado corretamente como SME", $radio)
            );
        }

        foreach ($smps as $smp) {
            $telefone = Telefone::parse($smp);
            $this->assertEquals($smp, $telefone->getNumeroDoAssinante(), sprintf("Telefone: %s não foi registrado corretamente em NumeroDoAssinante", $smp));
            $this->assertEquals(
                Telefone::TELEFONE_SMP,
                $telefone->getTipo(),
                sprintf("Telefone: %s não foi registrado corretamente como SME", $smp)
            );
        }

    }

    // 10 digitos pode ser fixo(STFC) ou radio (SME) ou SMP(sem o 9) com codigo de area
    // 11 digitos pode ser SMP com codigo de area
    public function testNumerosCom10e11e12e13DevemIdentificarOCodioDeArea()
    {
        $numeros = [
            '47' => '554734525289',
            '11' => '1137891234',
            '42' => '5542981231234',
            '98' => '98981239876',
            '41' => '41984196909'
        ];

        foreach ($numeros as $codigo => $tel) {
            $telefone = Telefone::parse($tel);
            $this->assertEquals(
                $codigo,
                $telefone->getCodigoDeArea(),
                sprintf("O código de de área não foi armazenado corretamente para o telefone: %s",$tel)
            );
        }
    }


}
