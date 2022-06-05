<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220605170151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE research_template (id INT AUTO_INCREMENT NOT NULL, icon_id INT NOT NULL, status_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_6A9B484954B9D732 (icon_id), INDEX IDX_6A9B48496BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template_icons (id INT AUTO_INCREMENT NOT NULL, icon LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE template_status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) NOT NULL, icon LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE research_template ADD CONSTRAINT FK_6A9B484954B9D732 FOREIGN KEY (icon_id) REFERENCES template_icons (id)');
        $this->addSql('ALTER TABLE research_template ADD CONSTRAINT FK_6A9B48496BF700BD FOREIGN KEY (status_id) REFERENCES template_status (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE research_template DROP FOREIGN KEY FK_6A9B484954B9D732');
        $this->addSql('ALTER TABLE research_template DROP FOREIGN KEY FK_6A9B48496BF700BD');
        $this->addSql('DROP TABLE research_template');
        $this->addSql('DROP TABLE template_icons');
        $this->addSql('DROP TABLE template_status');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
