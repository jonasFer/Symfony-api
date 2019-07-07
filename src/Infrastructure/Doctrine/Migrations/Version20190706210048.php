<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190706210048 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ator (id INT AUTO_INCREMENT NOT NULL, empresa_id INT DEFAULT NULL, INDEX IDX_AD48E88E521E1991 (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE empresa (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ator ADD CONSTRAINT FK_AD48E88E521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('ALTER TABLE user ADD ator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649634A4351 FOREIGN KEY (ator_id) REFERENCES ator (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649634A4351 ON user (ator_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649634A4351');
        $this->addSql('ALTER TABLE ator DROP FOREIGN KEY FK_AD48E88E521E1991');
        $this->addSql('DROP TABLE ator');
        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP INDEX UNIQ_8D93D649634A4351 ON user');
        $this->addSql('ALTER TABLE user DROP ator_id');
    }
}
