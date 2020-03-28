<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200328183503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE policial_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pergunta_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE resposta_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE triagem_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE triagem_situacao (id VARCHAR(40) NOT NULL, descricao VARCHAR(80) NOT NULL, dt_ini TIMESTAMP(0) WITH TIME ZONE NOT NULL, dt_fim TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE cargo (id VARCHAR(30) NOT NULL, descricao VARCHAR(80) NOT NULL, abreviatura VARCHAR(80) NOT NULL, ordem INT NOT NULL, dt_ini TIMESTAMP(0) WITH TIME ZONE NOT NULL, dt_fim TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE policial (id INT NOT NULL, tipo_rh_id VARCHAR(30) NOT NULL, cargo_id VARCHAR(30) DEFAULT NULL, sexo_id VARCHAR(20) NOT NULL, rg VARCHAR(10) NOT NULL, nome VARCHAR(150) NOT NULL, data_nascimento TIMESTAMP(0) WITH TIME ZONE NOT NULL, quadro VARCHAR(30) NOT NULL, subquadro VARCHAR(20) NOT NULL, opm_meta4_id VARCHAR(15) NOT NULL, opm_nome VARCHAR(80) NOT NULL, opm_abrev VARCHAR(80) NOT NULL, created_at TIMESTAMP(0) WITH TIME ZONE NOT NULL, municipio_uf VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9EF773F241E1DB4 ON policial (tipo_rh_id)');
        $this->addSql('CREATE INDEX IDX_9EF773F813AC380 ON policial (cargo_id)');
        $this->addSql('CREATE INDEX IDX_9EF773F2B32DB58 ON policial (sexo_id)');
        $this->addSql('CREATE TABLE pergunta (id INT NOT NULL, pergunta TEXT NOT NULL, informacao TEXT NOT NULL, ordem INT NOT NULL, dt_ini TIMESTAMP(0) WITH TIME ZONE NOT NULL, dt_fim TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE tipo_rh (id VARCHAR(30) NOT NULL, descricao VARCHAR(80) NOT NULL, dt_ini TIMESTAMP(0) WITH TIME ZONE NOT NULL, dt_fim TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE resposta (id INT NOT NULL, pergunta_id_id INT NOT NULL, triagem_id_id INT NOT NULL, resposta BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62A969065C3220A6 ON resposta (pergunta_id_id)');
        $this->addSql('CREATE INDEX IDX_62A96906A62234F7 ON resposta (triagem_id_id)');
        $this->addSql('CREATE TABLE resultado_triagem (id VARCHAR(40) NOT NULL, descricao VARCHAR(40) NOT NULL, mensagem TEXT NOT NULL, dt_ini TIMESTAMP(0) WITH TIME ZONE NOT NULL, dt_fim TIMESTAMP(0) WITH TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sexo (id VARCHAR(20) NOT NULL, descricao VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE triagem (id INT NOT NULL, triagem_situacao_id VARCHAR(40) NOT NULL, policial_id INT NOT NULL, resultado_triagem_id VARCHAR(40) NOT NULL, dt_triagem TIMESTAMP(0) WITH TIME ZONE NOT NULL, ip inet NOT NULL, observacao VARCHAR(255) DEFAULT NULL, sintomas TEXT DEFAULT NULL, telefone_celular VARCHAR(20) NOT NULL, telefone_fixo VARCHAR(20) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B2085D742A62081F ON triagem (triagem_situacao_id)');
        $this->addSql('CREATE INDEX IDX_B2085D7419BD774C ON triagem (policial_id)');
        $this->addSql('CREATE INDEX IDX_B2085D74478DE9B5 ON triagem (resultado_triagem_id)');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT FK_9EF773F241E1DB4 FOREIGN KEY (tipo_rh_id) REFERENCES tipo_rh (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT FK_9EF773F813AC380 FOREIGN KEY (cargo_id) REFERENCES cargo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE policial ADD CONSTRAINT FK_9EF773F2B32DB58 FOREIGN KEY (sexo_id) REFERENCES sexo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT FK_62A969065C3220A6 FOREIGN KEY (pergunta_id_id) REFERENCES pergunta (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE resposta ADD CONSTRAINT FK_62A96906A62234F7 FOREIGN KEY (triagem_id_id) REFERENCES triagem (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE triagem ADD CONSTRAINT FK_B2085D742A62081F FOREIGN KEY (triagem_situacao_id) REFERENCES triagem_situacao (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE triagem ADD CONSTRAINT FK_B2085D7419BD774C FOREIGN KEY (policial_id) REFERENCES policial (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE triagem ADD CONSTRAINT FK_B2085D74478DE9B5 FOREIGN KEY (resultado_triagem_id) REFERENCES resultado_triagem (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE triagem DROP CONSTRAINT FK_B2085D742A62081F');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT FK_9EF773F813AC380');
        $this->addSql('ALTER TABLE triagem DROP CONSTRAINT FK_B2085D7419BD774C');
        $this->addSql('ALTER TABLE resposta DROP CONSTRAINT FK_62A969065C3220A6');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT FK_9EF773F241E1DB4');
        $this->addSql('ALTER TABLE triagem DROP CONSTRAINT FK_B2085D74478DE9B5');
        $this->addSql('ALTER TABLE policial DROP CONSTRAINT FK_9EF773F2B32DB58');
        $this->addSql('ALTER TABLE resposta DROP CONSTRAINT FK_62A96906A62234F7');
        $this->addSql('DROP SEQUENCE policial_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pergunta_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE resposta_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE triagem_id_seq CASCADE');
        $this->addSql('DROP TABLE triagem_situacao');
        $this->addSql('DROP TABLE cargo');
        $this->addSql('DROP TABLE policial');
        $this->addSql('DROP TABLE pergunta');
        $this->addSql('DROP TABLE tipo_rh');
        $this->addSql('DROP TABLE resposta');
        $this->addSql('DROP TABLE resultado_triagem');
        $this->addSql('DROP TABLE sexo');
        $this->addSql('DROP TABLE triagem');
    }
}
