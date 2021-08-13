<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210723152607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permutation ADD localite_depart_id INT DEFAULT NULL, ADD localite_final_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE permutation ADD CONSTRAINT FK_565560E7EB97C4D1 FOREIGN KEY (localite_depart_id) REFERENCES localite (id)');
        $this->addSql('ALTER TABLE permutation ADD CONSTRAINT FK_565560E759B2F400 FOREIGN KEY (localite_final_id) REFERENCES localite (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_565560E7EB97C4D1 ON permutation (localite_depart_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_565560E759B2F400 ON permutation (localite_final_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE permutation DROP FOREIGN KEY FK_565560E7EB97C4D1');
        $this->addSql('ALTER TABLE permutation DROP FOREIGN KEY FK_565560E759B2F400');
        $this->addSql('DROP INDEX UNIQ_565560E7EB97C4D1 ON permutation');
        $this->addSql('DROP INDEX UNIQ_565560E759B2F400 ON permutation');
        $this->addSql('ALTER TABLE permutation DROP localite_depart_id, DROP localite_final_id');
    }
}
