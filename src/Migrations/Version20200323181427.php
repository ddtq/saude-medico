<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200323181427 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE triagem_situacao_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sexo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tipo_rh_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE policial_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE resposta_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE triagem_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pergunta_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cargo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE triagem_situacao (id INT NOT NULL, descricao VARCHAR(80) NOT NULL, dt_ini TIMESTAMP(0) WITH TIME ZONE NOT NULL, dt_fim TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sexo (id INT NOT NULL, descricao VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tipo_rh (id INT NOT NULL, decricao VARCHAR(80) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE policial (id INT NOT NULL, tipo_rh_id_id INT NOT NULL, cargo_id_id INT NOT NULL, sexo_id_id INT NOT NULL, rg VARCHAR(10) NOT NULL, nome VARCHAR(150) NOT NULL, data_nascimento TIMESTAMP(0) WITH TIME ZONE NOT NULL, quadro VARCHAR(30) NOT NULL, subquadro VARCHAR(20) NOT NULL, opm_meta4_id VARCHAR(15) NOT NULL, opm_nome VARCHAR(80) NOT NULL, opm_abrev VARCHAR(80) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, municipio_uf VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9EF773FA175C2A7 ON policial (tipo_rh_id_id)');
        $this->addSql('CREATE INDEX IDX_9EF773FA1AF830E ON policial (cargo_id_id)');
        $this->addSql('CREATE INDEX IDX_9EF773FAEF5F747 ON policial (sexo_id_id)');
        $this->addSql('CREATE TABLE resposta (id INT NOT NULL, pergunta_id_id INT NOT NULL, triagem_id_id INT NOT NULL, resposta BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62A969065C3220A6 ON resposta (pergunta_id_id)');
        $this->addSql('CREATE INDEX IDX_62A96906A62234F7 ON resposta (triagem_id_id)');
        $this->addSql('CREATE TABLE triagem (id INT NOT NULL, triagem_situacao_id_id INT NOT NULL, policial_id_id INT NOT NULL, dt_hr_triagem TIMESTAMP(0) WITH TIME ZONE NOT NULL, ip VARCHAR(15) NOT NULL, observacao VARCHAR(255) DEFAULT NULL, simtomas TEXT DEFAULT NULL, telefone_celular VARCHAR(20) NOT NULL, telefone_fixo VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B2085D741A5EAB2B ON triagem (triagem_situacao_id_id)');
        $this->addSql('CREATE INDEX IDX_B2085D74CA6F918D ON triagem (policial_id_id)');
        $this->addSql('CREATE TABLE pergunta (id INT NOT NULL, pergunta TEXT NOT NULL, informacao TEXT NOT NULL, ordem INT NOT NULL, dt_ini TIMESTAMP(0) WITH TIME ZONE NOT NULL, dt_fim TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cargo (id INT NOT NULL, descricao VARCHAR(80) NOT NULL, ordem INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT FK_9EF773FA175C2A7 FOREIGN KEY (tipo_rh_id_id) REFERENCES tipo_rh (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT FK_9EF773FA1AF830E FOREIGN KEY (cargo_id_id) REFERENCES cargo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT FK_9EF773FAEF5F747 FOREIGN KEY (sexo_id_id) REFERENCES sexo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT FK_62A969065C3220A6 FOREIGN KEY (pergunta_id_id) REFERENCES pergunta (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT FK_62A96906A62234F7 FOREIGN KEY (triagem_id_id) REFERENCES triagem (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE triagem ADD CONSTRAINT FK_B2085D741A5EAB2B FOREIGN KEY (triagem_situacao_id_id) REFERENCES triagem_situacao (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE triagem ADD CONSTRAINT FK_B2085D74CA6F918D FOREIGN KEY (policial_id_id) REFERENCES policial (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE triagem DROP CONSTRAINT FK_B2085D741A5EAB2B');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT FK_9EF773FAEF5F747');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT FK_9EF773FA175C2A7');
        $this->addSql('ALTER TABLE triagem DROP CONSTRAINT FK_B2085D74CA6F918D');
        $this->addSql('ALTER TABLE resposta DROP CONSTRAINT FK_62A96906A62234F7');
        $this->addSql('ALTER TABLE resposta DROP CONSTRAINT FK_62A969065C3220A6');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT FK_9EF773FA1AF830E');
        $this->addSql('DROP SEQUENCE triagem_situacao_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sexo_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tipo_rh_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE policial_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE resposta_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE triagem_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pergunta_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cargo_id_seq CASCADE');
        $this->addSql('DROP TABLE triagem_situacao');
        $this->addSql('DROP TABLE sexo');
        $this->addSql('DROP TABLE tipo_rh');
        $this->addSql('DROP TABLE policial');
        $this->addSql('DROP TABLE resposta');
        $this->addSql('DROP TABLE triagem');
        $this->addSql('DROP TABLE pergunta');
        $this->addSql('DROP TABLE cargo');
    }
}
