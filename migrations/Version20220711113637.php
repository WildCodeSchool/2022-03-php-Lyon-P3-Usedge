<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711113637 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE research_plan (id INT AUTO_INCREMENT NOT NULL, research_template_id INT NOT NULL, coach VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, UNIQUE INDEX UNIQ_88EA6BAD4677FCD4 (research_template_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE research_plan_section (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, workshop_name VARCHAR(255) NOT NULL, workshop_description LONGTEXT NOT NULL, recommendation LONGTEXT NOT NULL, objectives LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE research_plan ADD CONSTRAINT FK_88EA6BAD4677FCD4 FOREIGN KEY (research_template_id) REFERENCES research_request (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE research_plan');
        $this->addSql('DROP TABLE research_plan_section');
    }
}
