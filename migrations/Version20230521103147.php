<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230521103147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ad (id INT AUTO_INCREMENT NOT NULL, town_id INT DEFAULT NULL, salary_id INT DEFAULT NULL, job_id INT DEFAULT NULL, recruiter_id INT DEFAULT NULL, employment_contract_id INT DEFAULT NULL, degree_id INT NOT NULL, slug VARCHAR(255) NOT NULL, number_ad VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, title VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_closed TINYINT(1) NOT NULL, contract_start_date DATETIME DEFAULT NULL, duration VARCHAR(255) DEFAULT NULL, description LONGTEXT NOT NULL, INDEX IDX_77E0ED5875E23604 (town_id), INDEX IDX_77E0ED58B0FDF16E (salary_id), INDEX IDX_77E0ED58BE04EA9 (job_id), INDEX IDX_77E0ED58156BE243 (recruiter_id), INDEX IDX_77E0ED58461F8ACA (employment_contract_id), INDEX IDX_77E0ED58B35C5756 (degree_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE answer_ad (id INT AUTO_INCREMENT NOT NULL, ad_id INT NOT NULL, candidate_id INT NOT NULL, message LONGTEXT DEFAULT NULL, INDEX IDX_62EAC20F4F34D596 (ad_id), INDEX IDX_62EAC20F91BD8781 (candidate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidate (id INT NOT NULL, address VARCHAR(255) NOT NULL, cv VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultant (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE degree (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, level VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE department (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, number VARCHAR(255) NOT NULL, department_uppercase VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employment_contract (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, acronym VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_category (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_list (id INT AUTO_INCREMENT NOT NULL, job_category_id INT NOT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_C3048E59712A86AB (job_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recruiter (id INT NOT NULL, company_id INT DEFAULT NULL, INDEX IDX_DE8633D8979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salary (id INT AUTO_INCREMENT NOT NULL, salary_category_id INT NOT NULL, amount VARCHAR(255) NOT NULL, INDEX IDX_9413BB71D45E3299 (salary_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salary_category (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE town (id INT AUTO_INCREMENT NOT NULL, department_town_id INT NOT NULL, name VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, INDEX IDX_4CE6C7A4C84BDEE7 (department_town_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, alias VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, phone_number VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED5875E23604 FOREIGN KEY (town_id) REFERENCES town (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58B0FDF16E FOREIGN KEY (salary_id) REFERENCES salary (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58BE04EA9 FOREIGN KEY (job_id) REFERENCES job_list (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiter (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58461F8ACA FOREIGN KEY (employment_contract_id) REFERENCES employment_contract (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58B35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id)');
        $this->addSql('ALTER TABLE answer_ad ADD CONSTRAINT FK_62EAC20F4F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
        $this->addSql('ALTER TABLE answer_ad ADD CONSTRAINT FK_62EAC20F91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consultant ADD CONSTRAINT FK_441282A1BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_list ADD CONSTRAINT FK_C3048E59712A86AB FOREIGN KEY (job_category_id) REFERENCES job_category (id)');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D8979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE recruiter ADD CONSTRAINT FK_DE8633D8BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE salary ADD CONSTRAINT FK_9413BB71D45E3299 FOREIGN KEY (salary_category_id) REFERENCES salary_category (id)');
        $this->addSql('ALTER TABLE town ADD CONSTRAINT FK_4CE6C7A4C84BDEE7 FOREIGN KEY (department_town_id) REFERENCES department (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED5875E23604');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58B0FDF16E');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58BE04EA9');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58156BE243');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58461F8ACA');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58B35C5756');
        $this->addSql('ALTER TABLE answer_ad DROP FOREIGN KEY FK_62EAC20F4F34D596');
        $this->addSql('ALTER TABLE answer_ad DROP FOREIGN KEY FK_62EAC20F91BD8781');
        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44BF396750');
        $this->addSql('ALTER TABLE consultant DROP FOREIGN KEY FK_441282A1BF396750');
        $this->addSql('ALTER TABLE job_list DROP FOREIGN KEY FK_C3048E59712A86AB');
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D8979B1AD6');
        $this->addSql('ALTER TABLE recruiter DROP FOREIGN KEY FK_DE8633D8BF396750');
        $this->addSql('ALTER TABLE salary DROP FOREIGN KEY FK_9413BB71D45E3299');
        $this->addSql('ALTER TABLE town DROP FOREIGN KEY FK_4CE6C7A4C84BDEE7');
        $this->addSql('DROP TABLE ad');
        $this->addSql('DROP TABLE answer_ad');
        $this->addSql('DROP TABLE candidate');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE consultant');
        $this->addSql('DROP TABLE degree');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE employment_contract');
        $this->addSql('DROP TABLE job_category');
        $this->addSql('DROP TABLE job_list');
        $this->addSql('DROP TABLE recruiter');
        $this->addSql('DROP TABLE salary');
        $this->addSql('DROP TABLE salary_category');
        $this->addSql('DROP TABLE town');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
