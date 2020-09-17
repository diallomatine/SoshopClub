<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200916213012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bank_account (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, card_id INT DEFAULT NULL, iban VARCHAR(255) NOT NULL, bic VARCHAR(255) NOT NULL, bank_id VARCHAR(255) NOT NULL, balance DOUBLE PRECISION NOT NULL, INDEX IDX_53A23E0AA76ED395 (user_id), UNIQUE INDEX UNIQ_53A23E0A4ACC9A20 (card_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bank_card (id INT AUTO_INCREMENT NOT NULL, card_number VARCHAR(255) NOT NULL, card_id VARCHAR(255) NOT NULL, status INT NOT NULL, expiration_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, email VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bank_account ADD CONSTRAINT FK_53A23E0AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE bank_account ADD CONSTRAINT FK_53A23E0A4ACC9A20 FOREIGN KEY (card_id) REFERENCES bank_card (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bank_account DROP FOREIGN KEY FK_53A23E0A4ACC9A20');
        $this->addSql('ALTER TABLE bank_account DROP FOREIGN KEY FK_53A23E0AA76ED395');
        $this->addSql('DROP TABLE bank_account');
        $this->addSql('DROP TABLE bank_card');
        $this->addSql('DROP TABLE user');
    }
}
