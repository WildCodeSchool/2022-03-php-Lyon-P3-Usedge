<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711113906 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE research_plan_section ADD research_plan_id INT NOT NULL');
        $this->addSql('ALTER TABLE research_plan_section ADD CONSTRAINT FK_D78BB2677137B281 FOREIGN KEY (research_plan_id) REFERENCES research_plan (id)');
        $this->addSql('CREATE INDEX IDX_D78BB2677137B281 ON research_plan_section (research_plan_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE research_plan_section DROP FOREIGN KEY FK_D78BB2677137B281');
        $this->addSql('DROP INDEX IDX_D78BB2677137B281 ON research_plan_section');
        $this->addSql('ALTER TABLE research_plan_section DROP research_plan_id');
    }
}
