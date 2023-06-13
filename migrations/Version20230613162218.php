<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230613162218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chip (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, design_id INTEGER NOT NULL, color VARCHAR(255) NOT NULL, value INTEGER NOT NULL, CONSTRAINT FK_AA29BCBBE41DC9B2 FOREIGN KEY (design_id) REFERENCES design (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_AA29BCBBE41DC9B2 ON chip (design_id)');
        $this->addSql('CREATE TABLE design (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, CONSTRAINT FK_CD4F5A307E3C61F9 FOREIGN KEY (owner_id) REFERENCES player (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_CD4F5A307E3C61F9 ON design (owner_id)');
        $this->addSql('CREATE TABLE player (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, passhash VARCHAR(255) DEFAULT NULL, is_admin BOOLEAN NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chip');
        $this->addSql('DROP TABLE design');
        $this->addSql('DROP TABLE player');
    }
}
