<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321194403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Popula tabela tipo_rh';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO tipo_rh (id, descricao) VALUES ('TIPO_RH_ATIVA','Ativa');");
        $this->addSql("INSERT INTO tipo_rh (id, descricao) VALUES ('TIPO_RH_INATIVO','Inativo');");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM tipo_rh WHERE id = 'TIPO_RH_ATIVA'");
        $this->addSql("DELETE FROM tipo_rh WHERE id = 'TIPO_RH_INATIVO'");
    }
}
