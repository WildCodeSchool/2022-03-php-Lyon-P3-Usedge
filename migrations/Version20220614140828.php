<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614140828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer CHANGE number_order number_order INT NOT NULL');
        $this->addSql('ALTER TABLE component ADD dtype VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE template_component CHANGE number_order number_order INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answer CHANGE number_order number_order INT DEFAULT NULL');
        $this->addSql('ALTER TABLE component DROP dtype');
        $this->addSql('ALTER TABLE template_component CHANGE number_order number_order INT DEFAULT NULL');
    }
}
