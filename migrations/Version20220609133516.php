<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220609133516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, answer LONGTEXT NOT NULL, number_order INT NOT NULL, INDEX IDX_DADD4A251E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE component (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, is_mandatory TINYINT(1) NOT NULL, title VARCHAR(255) DEFAULT NULL, question LONGTEXT DEFAULT NULL, helper_text LONGTEXT DEFAULT NULL, is_multiple TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template_component (id INT AUTO_INCREMENT NOT NULL, research_template_id INT DEFAULT NULL, component_id INT DEFAULT NULL, number_order INT NOT NULL, INDEX IDX_80ADD7E14677FCD4 (research_template_id), INDEX IDX_80ADD7E1E2ABAFFF (component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A251E27F6BF FOREIGN KEY (question_id) REFERENCES component (id)');
        $this->addSql('ALTER TABLE template_component ADD CONSTRAINT FK_80ADD7E14677FCD4 FOREIGN KEY (research_template_id) REFERENCES research_template (id)');
        $this->addSql('ALTER TABLE template_component ADD CONSTRAINT FK_80ADD7E1E2ABAFFF FOREIGN KEY (component_id) REFERENCES component (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A251E27F6BF');
        $this->addSql('ALTER TABLE template_component DROP FOREIGN KEY FK_80ADD7E1E2ABAFFF');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE component');
        $this->addSql('DROP TABLE template_component');
    }
}
