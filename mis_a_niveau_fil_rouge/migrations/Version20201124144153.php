<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124144153 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competance DROP FOREIGN KEY FK_1BB6FF28E13939B8');
        $this->addSql('ALTER TABLE competance ADD CONSTRAINT FK_1BB6FF28E13939B8 FOREIGN KEY (competance_id) REFERENCES niveau (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competance DROP FOREIGN KEY FK_1BB6FF28E13939B8');
        $this->addSql('ALTER TABLE competance ADD CONSTRAINT FK_1BB6FF28E13939B8 FOREIGN KEY (competance_id) REFERENCES competance (id)');
    }
}
