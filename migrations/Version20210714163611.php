<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210714163611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dren (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, adresse VARCHAR(50) DEFAULT NULL, tel VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ecole (id INT AUTO_INCREMENT NOT NULL, iep_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, INDEX IDX_9786AAC3DD4BBB2 (iep_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE iep (id INT AUTO_INCREMENT NOT NULL, localite_id INT NOT NULL, nom VARCHAR(150) NOT NULL, INDEX IDX_F0C8C763924DD2B5 (localite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE localite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(150) NOT NULL, prenoms VARCHAR(200) NOT NULL, tel VARCHAR(15) NOT NULL, matricule VARCHAR(20) NOT NULL, sexe TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE ecole ADD CONSTRAINT FK_9786AAC3DD4BBB2 FOREIGN KEY (iep_id) REFERENCES iep (id)');
        $this->addSql('ALTER TABLE iep ADD CONSTRAINT FK_F0C8C763924DD2B5 FOREIGN KEY (localite_id) REFERENCES localite (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ecole DROP FOREIGN KEY FK_9786AAC3DD4BBB2');
        $this->addSql('ALTER TABLE iep DROP FOREIGN KEY FK_F0C8C763924DD2B5');
        $this->addSql('DROP TABLE dren');
        $this->addSql('DROP TABLE ecole');
        $this->addSql('DROP TABLE iep');
        $this->addSql('DROP TABLE localite');
        $this->addSql('DROP TABLE user');
    }
}
