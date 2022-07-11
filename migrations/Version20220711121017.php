<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711121017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE research_plan DROP FOREIGN KEY FK_88EA6BAD4677FCD4');
        $this->addSql('DROP INDEX UNIQ_88EA6BAD4677FCD4 ON research_plan');
        $this->addSql('ALTER TABLE research_plan CHANGE research_template_id research_request_id INT NOT NULL');
        $this->addSql('ALTER TABLE research_plan ADD CONSTRAINT FK_88EA6BAD8664BECD FOREIGN KEY (research_request_id) REFERENCES research_request (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88EA6BAD8664BECD ON research_plan (research_request_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE research_plan DROP FOREIGN KEY FK_88EA6BAD8664BECD');
        $this->addSql('DROP INDEX UNIQ_88EA6BAD8664BECD ON research_plan');
        $this->addSql('ALTER TABLE research_plan CHANGE research_request_id research_template_id INT NOT NULL');
        $this->addSql('ALTER TABLE research_plan ADD CONSTRAINT FK_88EA6BAD4677FCD4 FOREIGN KEY (research_template_id) REFERENCES research_request (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_88EA6BAD4677FCD4 ON research_plan (research_template_id)');
    }
}
