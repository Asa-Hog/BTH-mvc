<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220429153115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD COLUMN img VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, email, acronym, name, pwd, type FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(255) DEFAULT NULL, acronym VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, pwd VARCHAR(255) NOT NULL, type VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO user (id, email, acronym, name, pwd, type) SELECT id, email, acronym, name, pwd, type FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
    }
}
