<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190706114412 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, note VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_CFBDFA148DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preference (id INT AUTO_INCREMENT NOT NULL, list_id INT DEFAULT NULL, sort_value VARCHAR(100) DEFAULT NULL, filter_value VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_5D69B0533DAE168B (list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, list_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, is_complete TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_527EDB253DAE168B (list_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_list (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, background VARCHAR(255) DEFAULT \'background.png\', background_path VARCHAR(255) DEFAULT \'background.png\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_377B6C63A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) NOT NULL, username VARCHAR(255) NOT NULL, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA148DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE preference ADD CONSTRAINT FK_5D69B0533DAE168B FOREIGN KEY (list_id) REFERENCES task_list (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB253DAE168B FOREIGN KEY (list_id) REFERENCES task_list (id)');
        $this->addSql('ALTER TABLE task_list ADD CONSTRAINT FK_377B6C63A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA148DB60186');
        $this->addSql('ALTER TABLE preference DROP FOREIGN KEY FK_5D69B0533DAE168B');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB253DAE168B');
        $this->addSql('ALTER TABLE task_list DROP FOREIGN KEY FK_377B6C63A76ED395');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE preference');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_list');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE refresh_tokens');
    }
}
