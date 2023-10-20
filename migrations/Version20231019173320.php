<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231019173320 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE switches ADD owner_id INT DEFAULT NULL, DROP owner');
        $this->addSql('ALTER TABLE switches ADD CONSTRAINT FK_F34AC2337E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F34AC2337E3C61F9 ON switches (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE switches DROP FOREIGN KEY FK_F34AC2337E3C61F9');
        $this->addSql('DROP INDEX IDX_F34AC2337E3C61F9 ON switches');
        $this->addSql('ALTER TABLE switches ADD owner VARCHAR(255) NOT NULL, DROP owner_id');
    }
}
