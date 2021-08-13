<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210725140206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE localite ADD permutation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE localite ADD CONSTRAINT FK_F5D7E4A9B410CD9F FOREIGN KEY (permutation_id) REFERENCES permutation (id)');
        $this->addSql('CREATE INDEX IDX_F5D7E4A9B410CD9F ON localite (permutation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE localite DROP FOREIGN KEY FK_F5D7E4A9B410CD9F');
        $this->addSql('DROP INDEX IDX_F5D7E4A9B410CD9F ON localite');
        $this->addSql('ALTER TABLE localite DROP permutation_id');
    }
}
