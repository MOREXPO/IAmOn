<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231020141204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_switch (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, switch_id INT DEFAULT NULL, INDEX IDX_ABB5025A76ED395 (user_id), INDEX IDX_ABB5025BE2FFB85 (switch_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_switch ADD CONSTRAINT FK_ABB5025A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_switch ADD CONSTRAINT FK_ABB5025BE2FFB85 FOREIGN KEY (switch_id) REFERENCES switches (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_switch DROP FOREIGN KEY FK_ABB5025A76ED395');
        $this->addSql('ALTER TABLE user_switch DROP FOREIGN KEY FK_ABB5025BE2FFB85');
        $this->addSql('DROP TABLE user_switch');
    }
}
