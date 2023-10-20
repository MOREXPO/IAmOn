<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231019182953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_F34AC233F9759E2E ON switches');
        $this->addSql('DROP INDEX UNIQ_F34AC2336875CEEB ON switches');
        $this->addSql('ALTER TABLE switches CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE switches CHANGE id id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F34AC233F9759E2E ON switches (private_uri)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F34AC2336875CEEB ON switches (public_uri)');
    }
}
