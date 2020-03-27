<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200327211300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE cargo_id_seq CASCADE');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT fk_9ef773f813ac380');
        $this->addSql('ALTER TABLE cargo ADD abreviatura VARCHAR(80) NOT NULL');
        $this->addSql('ALTER TABLE cargo ALTER id TYPE VARCHAR(80)');
        $this->addSql('ALTER TABLE cargo ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE policial ALTER cargo_id TYPE VARCHAR(80)');
        $this->addSql('ALTER TABLE policial ALTER cargo_id DROP DEFAULT');
        $this->addSql('ALTER TABLE public.policial
    ADD CONSTRAINT fk_9ef773f813ac380 FOREIGN KEY (cargo_id)
    REFERENCES public.cargo (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE policial DROP CONSTRAINT fk_9ef773f813ac380');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE cargo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE cargo DROP abreviatura');
        $this->addSql('ALTER TABLE cargo ALTER id TYPE INT');
        $this->addSql('ALTER TABLE cargo ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE cargo ALTER id TYPE INT');
        $this->addSql('ALTER TABLE policial ALTER cargo_id TYPE INT');
        $this->addSql('ALTER TABLE policial ALTER cargo_id DROP DEFAULT');
        $this->addSql('ALTER TABLE policial ALTER cargo_id TYPE INT');
        $this->addSql('ALTER TABLE public.policial
    ADD CONSTRAINT fk_9ef773f813ac380 FOREIGN KEY (cargo_id)
    REFERENCES public.cargo (id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION');
    }
}
