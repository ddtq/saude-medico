<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321195319 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Popula tabela pergunta';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("ALTER TABLE public.pergunta ADD COLUMN depende_de int DEFAULT NULL");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Está bem de Saúde?','',10,NULL,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Febre','Teve febre?',20,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Cansaço','Teve cansaço?',30,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Congestão nasal','Teve congestão nasal?',40,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Corrimento nasal (coriza)','Teve corrimento nasal(coriza)?',50,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Dificuldade para respirar','Sente dificuldade para respirar?',60,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Dor de cabeça','Teve dor de cabeça?',70,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Dor de garganta','Teve dor de garganta?',80,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Dores pelo corpo','Sente dor de garganta?',90,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Mal estar geral','Sente mal estar geral?',100,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Tosse','Teve tosse?',110,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Teve contato próximo com caso SUSPEITO de COVID-19 nos últimos 14 dias?','Entende-se como contato próximo uma pessoa envolvida em qualquer uma das seguintes situações:\n1. Estar a dois metros de um paciente com suspeita de caso por 2019-nCoV, dentro da mesma sala ou área de atendimento (ou aeronaves ou outros meios de transporte), por um período prolongado, sem uso de equipamento de pro-teção individual.\n2. Cuidar, morar, visitar ou compartilhar uma área ou sala de espera de assis-tência médica ou, ainda, nos casos de contato direto com fluidos corporais, enquanto não estiver em uso do EPI recomendado.',120,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Teve contato próximo com caso CONFIRMADO de COVID-19 nos últimos 14 dias?','Entende-se como contato próximo uma pessoa envolvida em qualquer uma das seguintes situações:\n1. Estar a dois metros de um paciente com suspeita de caso por 2019-nCoV, dentro da mesma sala ou área de atendimento (ou aeronaves ou outros meios de transporte), por um período prolongado, sem uso de equipamento de pro-teção individual.\n2. Cuidar, morar, visitar ou compartilhar uma área ou sala de espera de assis-tência médica ou, ainda, nos casos de contato direto com fluidos corporais, enquanto não estiver em uso do EPI recomendado.',130,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Esteve em outro país nos últimos 14 dias?','',140,1,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Alemanha','',150,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Austrália','',160,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Camboja','',170,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('China','',180,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Coreia do Norte','',190,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Coreia do Sul','',200,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Emirados Árabes Unidos','',210,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Filipinas','',220,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('França','',230,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Irã','',240,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Itália','',250,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Japão','',260,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Malásia','',270,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Singapura','',280,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Tailândia','',290,14,now());");
        $this->addSql("INSERT INTO public.pergunta (pergunta, informacao, depende_de, ordem, dt_ini) VALUES ('Vietnam','',300,14,now());");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("TRUNCATE TABLE public.pergunta CASCADE");
        $this->addSql("ALTER SEQUENCE IF EXISTS pergunta_id_seq RESTART");
        $this->addSql("ALTER TABLE public.pergunta DROP COLUMN depende_de");
    }
}
