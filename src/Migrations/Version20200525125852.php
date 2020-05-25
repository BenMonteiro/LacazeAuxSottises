<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200525125852 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE section ADD is_hidden TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFD261FDD1 FOREIGN KEY (belong_to_page_id) REFERENCES front_page (id)');
        $this->addSql('ALTER TABLE front_page ADD CONSTRAINT FK_2CDA0C4C8D0C9323 FOREIGN KEY (tab_id) REFERENCES front_tab (id)');
        $this->addSql('ALTER TABLE performance CHANGE event_id event_id INT NOT NULL');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D79681979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE front_page DROP FOREIGN KEY FK_2CDA0C4C8D0C9323');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D79681979B1AD6');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968171F7E88B');
        $this->addSql('ALTER TABLE performance CHANGE event_id event_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFD261FDD1');
        $this->addSql('ALTER TABLE section DROP is_hidden');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\'');
    }
}
