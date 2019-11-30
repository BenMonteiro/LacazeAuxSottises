<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191129102103 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cies (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, theme VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, duration INT NOT NULL, audience VARCHAR(255) NOT NULL, further_infos LONGTEXT DEFAULT NULL, description LONGTEXT NOT NULL, web_site VARCHAR(255) DEFAULT NULL, video_link VARCHAR(255) DEFAULT NULL, in_creation TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE date (id INT AUTO_INCREMENT NOT NULL, cies_id INT NOT NULL, date DATETIME NOT NULL, INDEX IDX_AA9E377AB9913CF9 (cies_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE date ADD CONSTRAINT FK_AA9E377AB9913CF9 FOREIGN KEY (cies_id) REFERENCES cies (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE date DROP FOREIGN KEY FK_AA9E377AB9913CF9');
        $this->addSql('DROP TABLE cies');
        $this->addSql('DROP TABLE date');
    }
}
