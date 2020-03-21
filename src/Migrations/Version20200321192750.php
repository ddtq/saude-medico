<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321192750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Popula tabela cargo';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("ALTER TABLE public.cargo ADD COLUMN abreviatura character varying(80);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('CEL','Coronel', 'Cel.', 10);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('TENCEL','Tenente-Coronel', 'Ten.-Cel.', 20);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('MAJ','Major', 'Maj.', 30);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('CAP','Capitão', 'Cap.', 40);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('1TEN','1º Tenente', '1º Ten.', 50);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('2TEN','2º Tenente', '2º Ten.', 60);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('ASPOF','Aspirante-a-Oficial', 'Asp. Of.', 70);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('ALUNO','Aluno', 'Al.', 80);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('ALUNO3A','Aluno 3º Ano', 'Al. 3º Ano', 90);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('ALUNO2A','Aluno 2º Ano', 'Al. 2º Ano', 100);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('ALUNO1A','Aluno 3º Ano', 'Al. 1º Ano', 110);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('SUBTEN','Subtenente', 'Subten.', 120);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('1SGT','1º Sargento', '1º Sgt.', 130);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('2SGT','2º Sargento', '2º Sgt.', 140);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('3SGT','3º Sargento', '3º Sgt.', 150);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('CABO','Cabo', 'Cb.', 160);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('SD1C','Soldado', 'Sd.', 170);");
        $this->addSql("INSERT INTO public.cargo (id, descricao, abreviatura, ordem) VALUES ('SD2C','Soldado 2ª Classe', 'Sd.', 180);");
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
        $this->addSql('ALTER TABLE public.cargo DROP COLUMN abreviatura;');
    }
}
