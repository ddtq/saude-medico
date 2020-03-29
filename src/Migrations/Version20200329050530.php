<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329050530 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO triagem_situacao (id, descricao, dt_ini) VALUES ('REGISTRADA', 'Autoavaliação registrada. Aguardando contato com médico', now())");

    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DELETE FROM triagem_situacao WHERE id = 'REGISTRADA'");
    }
}
