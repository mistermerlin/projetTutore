<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210726073420 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permutation ADD destination_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE permutation ADD CONSTRAINT FK_565560E7816C6140 FOREIGN KEY (destination_id) REFERENCES localite (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_565560E7816C6140 ON permutation (destination_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permutation DROP FOREIGN KEY FK_565560E7816C6140');
        $this->addSql('DROP INDEX UNIQ_565560E7816C6140 ON permutation');
        $this->addSql('ALTER TABLE permutation DROP destination_id');
    }
}
