<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124143845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, critere_evaluation VARCHAR(255) NOT NULL, groupe_action VARCHAR(255) NOT NULL, isdeleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competance ADD competance_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE competance ADD CONSTRAINT FK_1BB6FF28E13939B8 FOREIGN KEY (competance_id) REFERENCES competance (id)');
        $this->addSql('CREATE INDEX IDX_1BB6FF28E13939B8 ON competance (competance_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE niveau');
        $this->addSql('ALTER TABLE competance DROP FOREIGN KEY FK_1BB6FF28E13939B8');
        $this->addSql('DROP INDEX IDX_1BB6FF28E13939B8 ON competance');
        $this->addSql('ALTER TABLE competance DROP competance_id');
    }
}
