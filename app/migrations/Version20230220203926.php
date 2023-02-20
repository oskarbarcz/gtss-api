<?php

declare(strict_types=1);

namespace Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20230220203926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE schedule_request (id INT AUTO_INCREMENT NOT NULL, operator_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', line_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', status VARCHAR(255) NOT NULL, departure_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B6FDA32E584598A3 (operator_id), INDEX IDX_B6FDA32E4D7B7542 (line_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE schedule_request ADD CONSTRAINT FK_B6FDA32E584598A3 FOREIGN KEY (operator_id) REFERENCES operator (id)');
        $this->addSql('ALTER TABLE schedule_request ADD CONSTRAINT FK_B6FDA32E4D7B7542 FOREIGN KEY (line_id) REFERENCES line (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule_request DROP FOREIGN KEY FK_B6FDA32E584598A3');
        $this->addSql('ALTER TABLE schedule_request DROP FOREIGN KEY FK_B6FDA32E4D7B7542');
        $this->addSql('DROP TABLE schedule_request');
    }
}
