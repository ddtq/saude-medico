<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328184651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Popula tabelas';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO sexo (id, descricao) VALUES ('MASCULINO','Masculino');");
        $this->addSql("INSERT INTO sexo (id, descricao) VALUES ('FEMININO','Feminino');");

        $this->addSql("INSERT INTO tipo_rh (id, descricao, dt_ini) VALUES ('ATIVA','Ativa', now());");
        $this->addSql("INSERT INTO tipo_rh (id, descricao, dt_ini) VALUES ('APOSENTADO','Aposentado', now());");

        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('CEL','Coronel', 'Cel.', 10, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('TENCEL','Tenente-Coronel', 'Ten.-Cel.', 20, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('MAJ','Major', 'Maj.', 30, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('CAP','Capitão', 'Cap.', 40, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('1TEN','1º Tenente', '1º Ten.', 50, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('2TEN','2º Tenente', '2º Ten.', 60, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('ASPOF','Aspirante-a-Oficial', 'Asp. Of.', 70, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('ALUNO','Aluno', 'Al.', 80, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('ALUNO3A','Aluno 3º Ano', 'Al. 3º Ano', 90, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('ALUNO2A','Aluno 2º Ano', 'Al. 2º Ano', 100, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('ALUNO1A','Aluno 3º Ano', 'Al. 1º Ano', 110, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('SUBTEN','Subtenente', 'Subten.', 120, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('1SGT','1º Sargento', '1º Sgt.', 130, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('2SGT','2º Sargento', '2º Sgt.', 140, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('3SGT','3º Sargento', '3º Sgt.', 150, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('CABO','Cabo', 'Cb.', 160, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('SD1C','Soldado', 'Sd.', 170, now());");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem, dt_ini) VALUES ('SD2C','Soldado 2ª Classe', 'Sd.', 180, now());");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM public.cargo WHERE id = 'CEL'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'TENCEL'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'MAJ'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'CAP'");
        $this->addSql("DELETE FROM public.cargo WHERE id = '1TEN'");
        $this->addSql("DELETE FROM public.cargo WHERE id = '2TEN'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'ASPOF'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'ALUNO'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'ALUNO3A'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'ALUNO2A'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'ALUNO1A'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'SUBTEN'");
        $this->addSql("DELETE FROM public.cargo WHERE id = '1SGT'");
        $this->addSql("DELETE FROM public.cargo WHERE id = '2SGT'");
        $this->addSql("DELETE FROM public.cargo WHERE id = '3SGT'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'CABO'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'SD1C'");
        $this->addSql("DELETE FROM public.cargo WHERE id = 'SD2C'");

        $this->addSql("DELETE FROM tipo_rh WHERE id = 'ATIVA'");
        $this->addSql("DELETE FROM tipo_rh WHERE id = 'APOSENTADO'");

        $this->addSql("DELETE FROM sexo WHERE id = 'MASCULINO'");
        $this->addSql("DELETE FROM sexo WHERE id = 'FEMININO'");
    }
}
