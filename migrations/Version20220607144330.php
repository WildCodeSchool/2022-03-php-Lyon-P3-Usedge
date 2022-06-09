<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607144330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE template_component (id INT AUTO_INCREMENT NOT NULL, research_template_id INT DEFAULT NULL, component_id INT DEFAULT NULL, number_order INT DEFAULT NULL, INDEX IDX_80ADD7E14677FCD4 (research_template_id), INDEX IDX_80ADD7E1E2ABAFFF (component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE template_component ADD CONSTRAINT FK_80ADD7E14677FCD4 FOREIGN KEY (research_template_id) REFERENCES research_template (id)');
        $this->addSql('ALTER TABLE template_component ADD CONSTRAINT FK_80ADD7E1E2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE template_component');
    }
}
