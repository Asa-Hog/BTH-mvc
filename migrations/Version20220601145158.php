<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220601145158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_4CD0D36E8BAC62AF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__weather AS SELECT id, city_id, temperature, years, precipitation, frost, summer, prec_days FROM weather');
        $this->addSql('DROP TABLE weather');
        $this->addSql('CREATE TABLE weather (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id INTEGER NOT NULL, temperature CLOB NOT NULL --(DC2Type:array)
        , years CLOB NOT NULL --(DC2Type:array)
        , precipitation CLOB NOT NULL --(DC2Type:array)
        , frost CLOB NOT NULL --(DC2Type:array)
        , summer CLOB NOT NULL --(DC2Type:array)
        , prec_days CLOB NOT NULL --(DC2Type:array)
        , CONSTRAINT FK_4CD0D36E8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO weather (id, city_id, temperature, years, precipitation, frost, summer, prec_days) SELECT id, city_id, temperature, years, precipitation, frost, summer, prec_days FROM __temp__weather');
        $this->addSql('DROP TABLE __temp__weather');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4CD0D36E8BAC62AF ON weather (city_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_4CD0D36E8BAC62AF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__weather AS SELECT id, city_id, years, temperature, precipitation, frost, summer, prec_days FROM weather');
        $this->addSql('DROP TABLE weather');
        $this->addSql('CREATE TABLE weather (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, city_id INTEGER NOT NULL, years CLOB NOT NULL --(DC2Type:array)
        , temperature CLOB NOT NULL --(DC2Type:array)
        , precipitation CLOB NOT NULL --(DC2Type:array)
        , frost CLOB NOT NULL --(DC2Type:array)
        , summer CLOB NOT NULL --(DC2Type:array)
        , prec_days CLOB NOT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO weather (id, city_id, years, temperature, precipitation, frost, summer, prec_days) SELECT id, city_id, years, temperature, precipitation, frost, summer, prec_days FROM __temp__weather');
        $this->addSql('DROP TABLE __temp__weather');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4CD0D36E8BAC62AF ON weather (city_id)');
    }
}
