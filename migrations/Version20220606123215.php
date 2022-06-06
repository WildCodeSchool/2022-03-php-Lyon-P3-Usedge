<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220606123215 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE research_template DROP FOREIGN KEY FK_6A9B484954B9D732');
        $this->addSql('ALTER TABLE research_template DROP FOREIGN KEY FK_6A9B48496BF700BD');
        $this->addSql('DROP TABLE template_icons');
        $this->addSql('DROP TABLE template_status');
        $this->addSql('DROP INDEX IDX_6A9B484954B9D732 ON research_template');
        $this->addSql('DROP INDEX IDX_6A9B48496BF700BD ON research_template');
        $this->addSql('ALTER TABLE research_template ADD icon VARCHAR(255) NOT NULL, ADD status VARCHAR(255) DEFAULT NULL, DROP icon_id, DROP status_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE template_icons (id INT AUTO_INCREMENT NOT NULL, icon LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE template_status (id INT AUTO_INCREMENT NOT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, icon LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE research_template ADD icon_id INT NOT NULL, ADD status_id INT DEFAULT NULL, DROP icon, DROP status');
        $this->addSql('ALTER TABLE research_template ADD CONSTRAINT FK_6A9B484954B9D732 FOREIGN KEY (icon_id) REFERENCES template_icons (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE research_template ADD CONSTRAINT FK_6A9B48496BF700BD FOREIGN KEY (status_id) REFERENCES template_status (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_6A9B484954B9D732 ON research_template (icon_id)');
        $this->addSql('CREATE INDEX IDX_6A9B48496BF700BD ON research_template (status_id)');
    }
}
