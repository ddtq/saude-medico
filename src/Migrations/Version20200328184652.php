<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use App\Entity\Pergunta;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328184652 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $perguntasArray = [
            [
                "id" => 1,
                "pergunta" => "Cansaço",
                "informacao" => "Cansaço",
                "ordem" => 3,
            ],
            [
                "id" => 2,
                "pergunta" => "Congestão Nasal",
                "informacao" => "Congestão nasal",
                "ordem" => 4,
            ],
            [
                "id" => 3,
                "pergunta" => "Corrimento Nasal (Coriza)",
                "informacao" => "Corrimento nasal (coriza)",
                "ordem" => 5,
            ],
            [
                "id" => 4,
                "pergunta" => "Dificuldade para respirar",
                "informacao" => "Dificuldade para respirar",
                "ordem" => 6,
            ],
            [
                "id" => 5,
                "pergunta" => "Dor de cabeça",
                "informacao" => "Dor de cabeça",
                "ordem" => 7,
            ],
            [
                "id" => 6,
                "pergunta" => "Dor de garganta",
                "informacao" => "Dor de garganta",
                "ordem" => 8,
            ],
            [
                "id" => 7,
                "pergunta" => "Dores pelo corpo",
                "informacao" => "Dores pelo corpo",
                "ordem" => 9,
            ],
            [
                "id" => 8,
                "pergunta" => "Febre",
                "informacao" => "Febre",
                "ordem" => 10,
            ],
            [
                "id" => 9,
                "pergunta" => "Mal estar geral",
                "informacao" => "Mal estar geral",
                "ordem" => 11,
            ],
            [
                "id" => 10,
                "pergunta" => "Tosse",
                "informacao" => "Tosse",
                "ordem" => 12,
            ],
            [
                "id" => 11,
                "pergunta" => "inicio sintomas",
                "informacao" => "Início dos sintomas",
                "ordem" => 2,
            ],
            [
                "id" => 12,
                "pergunta" => "contato suspeito",
                "informacao" => "Contato com caso suspeito de coronavirus",
                "ordem" => 13,
            ],
            [
                "id" => 13,
                "pergunta" => "contato confirmado",
                "informacao" => "Contato com caso confirmado de coronavirus",
                "ordem" => 14,
            ],
            [
                "id" => 14,
                "pergunta" => "esteve em outro país",
                "informacao" => "Esteve em outro país",
                "ordem" => 15,
            ],
            [
                "id" => 15,
                "pergunta" => "onde",
                "informacao" => "País onde esteve",
                "ordem" => 16,
            ],
            [
                "id" => 16,
                "pergunta" => "cidade",
                "informacao" => "Cidade onde está",
                "ordem" => 1,
            ],
        ];

        foreach ($perguntasArray as $p) {

            $this->addSql("INSERT INTO pergunta (id,pergunta,informacao,ordem,dt_ini) VALUES ({$p['id']},'{$p['pergunta']}','{$p['informacao']}',{$p['ordem']},CURRENT_TIMESTAMP )");

        }

    }

    public function down(Schema $schema) : void
    {
        $this->addSql('TRUNCATE TABLE public.pergunta CASCADE');
        $this->addSql('ALTER SEQUENCE public.pergunta_id_seq RESTART');

    }
}
