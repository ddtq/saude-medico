<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200327210103 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE policial DROP CONSTRAINT fk_9ef773fa175c2a7');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT fk_9ef773fa1af830e');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT fk_9ef773faef5f747');
        $this->addSql('DROP INDEX idx_9ef773fa1af830e');
        $this->addSql('DROP INDEX idx_9ef773faef5f747');
        $this->addSql('DROP INDEX idx_9ef773fa175c2a7');
        $this->addSql('ALTER TABLE policial ADD tipo_rh_id INT NOT NULL');
        $this->addSql('ALTER TABLE policial ADD cargo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE policial ADD sexo_id INT NOT NULL');
        $this->addSql('ALTER TABLE policial DROP tipo_rh_id_id');
        $this->addSql('ALTER TABLE policial DROP cargo_id_id');
        $this->addSql('ALTER TABLE policial DROP sexo_id_id');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT FK_9EF773F241E1DB4 FOREIGN KEY (tipo_rh_id) REFERENCES tipo_rh (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT FK_9EF773F813AC380 FOREIGN KEY (cargo_id) REFERENCES cargo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT FK_9EF773F2B32DB58 FOREIGN KEY (sexo_id) REFERENCES sexo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9EF773F241E1DB4 ON policial (tipo_rh_id)');
        $this->addSql('CREATE INDEX IDX_9EF773F813AC380 ON policial (cargo_id)');
        $this->addSql('CREATE INDEX IDX_9EF773F2B32DB58 ON policial (sexo_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT FK_9EF773F241E1DB4');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT FK_9EF773F813AC380');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT FK_9EF773F2B32DB58');
        $this->addSql('DROP INDEX IDX_9EF773F241E1DB4');
        $this->addSql('DROP INDEX IDX_9EF773F813AC380');
        $this->addSql('DROP INDEX IDX_9EF773F2B32DB58');
        $this->addSql('ALTER TABLE policial ADD tipo_rh_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE policial ADD cargo_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE policial ADD sexo_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE policial DROP tipo_rh_id');
        $this->addSql('ALTER TABLE policial DROP cargo_id');
        $this->addSql('ALTER TABLE policial DROP sexo_id');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT fk_9ef773fa175c2a7 FOREIGN KEY (tipo_rh_id_id) REFERENCES tipo_rh (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT fk_9ef773fa1af830e FOREIGN KEY (cargo_id_id) REFERENCES cargo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT fk_9ef773faef5f747 FOREIGN KEY (sexo_id_id) REFERENCES sexo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9ef773fa1af830e ON policial (cargo_id_id)');
        $this->addSql('CREATE INDEX idx_9ef773faef5f747 ON policial (sexo_id_id)');
        $this->addSql('CREATE INDEX idx_9ef773fa175c2a7 ON policial (tipo_rh_id_id)');
    }
}
