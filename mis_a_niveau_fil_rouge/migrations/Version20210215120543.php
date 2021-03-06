<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210215120543 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE competance_competance');
        $this->addSql('DROP TABLE groupe_cometance_groupe_cometance');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competance_competance (competance_source INT NOT NULL, competance_target INT NOT NULL, INDEX IDX_BF4A22BCA6B069ED (competance_source), INDEX IDX_BF4A22BCBF553962 (competance_target), PRIMARY KEY(competance_source, competance_target)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE groupe_cometance_groupe_cometance (groupe_cometance_source INT NOT NULL, groupe_cometance_target INT NOT NULL, INDEX IDX_8272CB506B928ACE (groupe_cometance_source), INDEX IDX_8272CB507277DA41 (groupe_cometance_target), PRIMARY KEY(groupe_cometance_source, groupe_cometance_target)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE competance_competance ADD CONSTRAINT FK_BF4A22BCA6B069ED FOREIGN KEY (competance_source) REFERENCES competance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competance_competance ADD CONSTRAINT FK_BF4A22BCBF553962 FOREIGN KEY (competance_target) REFERENCES competance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_cometance_groupe_cometance ADD CONSTRAINT FK_8272CB506B928ACE FOREIGN KEY (groupe_cometance_source) REFERENCES groupe_cometance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_cometance_groupe_cometance ADD CONSTRAINT FK_8272CB507277DA41 FOREIGN KEY (groupe_cometance_target) REFERENCES groupe_cometance (id) ON DELETE CASCADE');
    }
}
