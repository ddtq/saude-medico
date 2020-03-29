<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200329062939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql("INSERT INTO resultado_triagem  (id,descricao,mensagem,dt_ini) VALUES ('CASO_NAO_SE_ENQUADRA', 'Caso não se enquadra', 'Essa mensagem será exibida caso não se enquadre como caso suspeito ou provável', now())");
        $this->addSql("INSERT INTO resultado_triagem  (id,descricao,mensagem,dt_ini) VALUES ('CASO_SUSPEITO_OU_PROVAVEL', 'Caso suspeito ou provável.', 'Atenção essa afirmação não se trata de um diagnóstico. Procure atendimento médico. A Corporação manterá acompanhamento do seu caso.', now())");
    }

    public function down(Schema $schema) : void
    {
        $this->addSql("DROP FROM resultado_triagem WHERE id = 'CASO_NAO_SE_ENQUADRA'");
        $this->addSql("DROP FROM resultado_triagem WHERE id = 'CASO_SUSPEITO_OU_PROVAVEL'");

    }
}
