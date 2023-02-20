<?php

declare(strict_types=1);

namespace Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214230141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE city (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', operator_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, INDEX IDX_D114B4F6584598A3 (operator_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE operator (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE station (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', city_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', short_name VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) NOT NULL, INDEX IDX_9F39F8B18BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stop (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', train_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', station_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', scheduled_arrival_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', scheduled_departure_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', predicted_arrival_time DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', predicted_departure_time DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B95616B623BCD4D0 (train_id), INDEX IDX_B95616B621BDB235 (station_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE train (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', line_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', number VARCHAR(255) NOT NULL, INDEX IDX_5C66E4A34D7B7542 (line_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE line ADD CONSTRAINT FK_D114B4F6584598A3 FOREIGN KEY (operator_id) REFERENCES operator (id)');
        $this->addSql('ALTER TABLE station ADD CONSTRAINT FK_9F39F8B18BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE stop ADD CONSTRAINT FK_B95616B623BCD4D0 FOREIGN KEY (train_id) REFERENCES train (id)');
        $this->addSql('ALTER TABLE stop ADD CONSTRAINT FK_B95616B621BDB235 FOREIGN KEY (station_id) REFERENCES station (id)');
        $this->addSql('ALTER TABLE train ADD CONSTRAINT FK_5C66E4A34D7B7542 FOREIGN KEY (line_id) REFERENCES line (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE line DROP FOREIGN KEY FK_D114B4F6584598A3');
        $this->addSql('ALTER TABLE station DROP FOREIGN KEY FK_9F39F8B18BAC62AF');
        $this->addSql('ALTER TABLE stop DROP FOREIGN KEY FK_B95616B623BCD4D0');
        $this->addSql('ALTER TABLE stop DROP FOREIGN KEY FK_B95616B621BDB235');
        $this->addSql('ALTER TABLE train DROP FOREIGN KEY FK_5C66E4A34D7B7542');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE line');
        $this->addSql('DROP TABLE operator');
        $this->addSql('DROP TABLE station');
        $this->addSql('DROP TABLE stop');
        $this->addSql('DROP TABLE train');
    }
}
