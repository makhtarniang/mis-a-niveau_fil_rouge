<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201124160736 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tag_tag (tag_source INT NOT NULL, tag_target INT NOT NULL, INDEX IDX_2572D81B6CB365F (tag_source), INDEX IDX_2572D81AF2E66D0 (tag_target), PRIMARY KEY(tag_source, tag_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_tag ADD CONSTRAINT FK_2572D81B6CB365F FOREIGN KEY (tag_source) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_tag ADD CONSTRAINT FK_2572D81AF2E66D0 FOREIGN KEY (tag_target) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tag_tag');
    }
}
