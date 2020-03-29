<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329050401 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE resposta DROP CONSTRAINT fk_62a969065c3220a6');
        $this->addSql('ALTER TABLE resposta DROP CONSTRAINT fk_62a96906a62234f7');
        $this->addSql('DROP INDEX idx_62a96906a62234f7');
        $this->addSql('DROP INDEX idx_62a969065c3220a6');
        $this->addSql('ALTER TABLE resposta ADD pergunta_id INT NOT NULL');
        $this->addSql('ALTER TABLE resposta ADD triagem_id INT NOT NULL');
        $this->addSql('ALTER TABLE resposta ADD text VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE resposta DROP pergunta_id_id');
        $this->addSql('ALTER TABLE resposta DROP triagem_id_id');
        $this->addSql('ALTER TABLE resposta RENAME COLUMN resposta TO selected');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT FK_62A969063C763537 FOREIGN KEY (pergunta_id) REFERENCES pergunta (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT FK_62A969063477AE25 FOREIGN KEY (triagem_id) REFERENCES triagem (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_62A969063C763537 ON resposta (pergunta_id)');
        $this->addSql('CREATE INDEX IDX_62A969063477AE25 ON resposta (triagem_id)');
        $this->addSql('ALTER TABLE triagem ALTER ip TYPE inet');
        $this->addSql('ALTER TABLE triagem ALTER ip DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE resposta DROP CONSTRAINT FK_62A969063C763537');
        $this->addSql('ALTER TABLE resposta DROP CONSTRAINT FK_62A969063477AE25');
        $this->addSql('DROP INDEX IDX_62A969063C763537');
        $this->addSql('DROP INDEX IDX_62A969063477AE25');
        $this->addSql('ALTER TABLE resposta ADD pergunta_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE resposta ADD triagem_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE resposta DROP pergunta_id');
        $this->addSql('ALTER TABLE resposta DROP triagem_id');
        $this->addSql('ALTER TABLE resposta DROP text');
        $this->addSql('ALTER TABLE resposta RENAME COLUMN selected TO resposta');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT fk_62a969065c3220a6 FOREIGN KEY (pergunta_id_id) REFERENCES pergunta (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT fk_62a96906a62234f7 FOREIGN KEY (triagem_id_id) REFERENCES triagem (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_62a96906a62234f7 ON resposta (triagem_id_id)');
        $this->addSql('CREATE INDEX idx_62a969065c3220a6 ON resposta (pergunta_id_id)');
        $this->addSql('ALTER TABLE triagem ALTER ip TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE triagem ALTER ip DROP DEFAULT');
    }
}
