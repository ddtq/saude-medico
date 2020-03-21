<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321191351 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Popula tabela sexo';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO sexo (id, descricao) VALUES ('MASCULINO','Masculino');");
        $this->addSql("INSERT INTO sexo (id, descricao) VALUES ('FEMININO','Feminino');");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('TRUNCATE public.sexo CASCADE;');
    }
}
