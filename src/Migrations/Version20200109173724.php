<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200109173724 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, updated_at DATETIME DEFAULT NULL, is_in_diffusion TINYINT(1) NOT NULL, is_in_creation TINYINT(1) NOT NULL, website VARCHAR(255) DEFAULT NULL, video_link VARCHAR(255) DEFAULT NULL, theme VARCHAR(255) DEFAULT NULL, audience VARCHAR(255) NOT NULL, more_infos LONGTEXT DEFAULT NULL, duration INT NOT NULL, show_title VARCHAR(255) DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_original_name VARCHAR(255) DEFAULT NULL, image_mime_type VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, image_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, starting_date DATE DEFAULT NULL, ending_date DATE DEFAULT NULL, hours VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, program_pdf_name VARCHAR(255) DEFAULT NULL, program_pdf_original_name VARCHAR(255) DEFAULT NULL, program_pdf_mime_type VARCHAR(255) DEFAULT NULL, program_pdf_size INT DEFAULT NULL, program_pdf_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', program_image_name VARCHAR(255) DEFAULT NULL, program_image_original_name VARCHAR(255) DEFAULT NULL, program_image_mime_type VARCHAR(255) DEFAULT NULL, program_image_size INT DEFAULT NULL, program_image_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE front_page (id INT AUTO_INCREMENT NOT NULL, tab_id INT NOT NULL, name VARCHAR(255) NOT NULL, page_slug VARCHAR(255) NOT NULL, INDEX IDX_2CDA0C4C8D0C9323 (tab_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE front_tab (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, updated_at DATETIME DEFAULT NULL, type VARCHAR(255) NOT NULL, logo_name VARCHAR(255) DEFAULT NULL, logo_original_name VARCHAR(255) DEFAULT NULL, logo_mime_type VARCHAR(255) DEFAULT NULL, logo_size INT DEFAULT NULL, logo_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE performance (id INT AUTO_INCREMENT NOT NULL, company_name_id INT NOT NULL, event_id INT DEFAULT NULL, city_show VARCHAR(255) NOT NULL, place_show VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_82D7968151458601 (company_name_id), INDEX IDX_82D7968171F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, belong_to_page_id INT NOT NULL, name VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL, sub_title VARCHAR(255) DEFAULT NULL, appearance_order INT NOT NULL, content LONGTEXT NOT NULL, updated_at DATETIME DEFAULT NULL, image_name VARCHAR(255) DEFAULT NULL, image_original_name VARCHAR(255) DEFAULT NULL, image_mime_type VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, image_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', INDEX IDX_2D737AEFD261FDD1 (belong_to_page_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, photo_name VARCHAR(255) DEFAULT NULL, photo_original_name VARCHAR(255) DEFAULT NULL, photo_mime_type VARCHAR(255) DEFAULT NULL, photo_size INT DEFAULT NULL, photo_dimensions LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:simple_array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE front_page ADD CONSTRAINT FK_2CDA0C4C8D0C9323 FOREIGN KEY (tab_id) REFERENCES front_tab (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968151458601 FOREIGN KEY (company_name_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE performance ADD CONSTRAINT FK_82D7968171F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEFD261FDD1 FOREIGN KEY (belong_to_page_id) REFERENCES front_page (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968151458601');
        $this->addSql('ALTER TABLE performance DROP FOREIGN KEY FK_82D7968171F7E88B');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEFD261FDD1');
        $this->addSql('ALTER TABLE front_page DROP FOREIGN KEY FK_2CDA0C4C8D0C9323');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE front_page');
        $this->addSql('DROP TABLE front_tab');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE performance');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE team');
    }
}
