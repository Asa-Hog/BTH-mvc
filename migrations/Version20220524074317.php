<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524074317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__weather AS SELECT id, temperature FROM weather');
        $this->addSql('DROP TABLE weather');
        $this->addSql('CREATE TABLE weather (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, temperature CLOB NOT NULL --(DC2Type:array)
        , years CLOB NOT NULL --(DC2Type:array)
        , precipitation CLOB NOT NULL --(DC2Type:array)
        , city_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO weather (id, temperature) SELECT id, temperature FROM __temp__weather');
        $this->addSql('DROP TABLE __temp__weather');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__weather AS SELECT id, temperature FROM weather');
        $this->addSql('DROP TABLE weather');
        $this->addSql('CREATE TABLE weather (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, temperature CLOB NOT NULL --(DC2Type:array)
        , year CLOB NOT NULL --(DC2Type:array)
        , prec CLOB NOT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO weather (id, temperature) SELECT id, temperature FROM __temp__weather');
        $this->addSql('DROP TABLE __temp__weather');
    }
}
