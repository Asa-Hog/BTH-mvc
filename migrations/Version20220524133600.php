<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220524133600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__weather AS SELECT id, temperature, years, precipitation, city_id, frost, summer, prec_days FROM weather');
        $this->addSql('DROP TABLE weather');
        $this->addSql('CREATE TABLE weather (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, temperature CLOB NOT NULL --(DC2Type:array)
        , years CLOB NOT NULL --(DC2Type:array)
        , precipitation CLOB NOT NULL --(DC2Type:array)
        , city_id INTEGER NOT NULL, frost CLOB NOT NULL --(DC2Type:array)
        , summer CLOB NOT NULL --(DC2Type:array)
        , prec_days CLOB NOT NULL --(DC2Type:array)
        )');
        $this->addSql('INSERT INTO weather (id, temperature, years, precipitation, city_id, frost, summer, prec_days) SELECT id, temperature, years, precipitation, city_id, frost, summer, prec_days FROM __temp__weather');
        $this->addSql('DROP TABLE __temp__weather');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__weather AS SELECT id, years, temperature, precipitation, city_id, frost, summer, prec_days FROM weather');
        $this->addSql('DROP TABLE weather');
        $this->addSql('CREATE TABLE weather (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, years CLOB NOT NULL --(DC2Type:array)
        , temperature CLOB NOT NULL --(DC2Type:array)
        , precipitation CLOB NOT NULL --(DC2Type:array)
        , city_id INTEGER NOT NULL, frost CLOB NOT NULL, summer CLOB NOT NULL, prec_days CLOB NOT NULL)');
        $this->addSql('INSERT INTO weather (id, years, temperature, precipitation, city_id, frost, summer, prec_days) SELECT id, years, temperature, precipitation, city_id, frost, summer, prec_days FROM __temp__weather');
        $this->addSql('DROP TABLE __temp__weather');
    }
}
