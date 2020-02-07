<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200207082440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE press_document (id INT AUTO_INCREMENT NOT NULL, updated_at DATETIME DEFAULT NULL, document_name VARCHAR(255) DEFAULT NULL, document_original_name VARCHAR(255) DEFAULT NULL, document_mime_type VARCHAR(255) DEFAULT NULL, document_size INT DEFAULT NULL, document_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968151458601');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968171F7E88B');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968151458601 FOREIGN KEY (company_name_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE press_document');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968151458601');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968171F7E88B');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968151458601 FOREIGN KEY (company_name_id) REFERENCES company (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968171F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON UPDATE CASCADE ON DELETE CASCADE');
    }
}
