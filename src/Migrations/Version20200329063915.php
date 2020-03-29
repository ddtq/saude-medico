<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329063915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE resposta ALTER selected DROP NOT NULL');
        $this->addSql('ALTER TABLE resposta ALTER text DROP NOT NULL');
        $this->addSql('ALTER TABLE triagem ALTER ip TYPE inet');
        $this->addSql('ALTER TABLE triagem ALTER ip DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE triagem ALTER ip TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE triagem ALTER ip DROP DEFAULT');
        $this->addSql('ALTER TABLE resposta ALTER selected SET NOT NULL');
        $this->addSql('ALTER TABLE resposta ALTER text SET NOT NULL');
    }
}
