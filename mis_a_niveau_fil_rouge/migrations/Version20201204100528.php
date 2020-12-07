<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201204100528 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competance_competance (competance_source INT NOT NULL, competance_target INT NOT NULL, INDEX IDX_BF4A22BCA6B069ED (competance_source), INDEX IDX_BF4A22BCBF553962 (competance_target), PRIMARY KEY(competance_source, competance_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_cometance (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, isdeleted TINYINT(1) NOT NULL, descriptif VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_cometance_groupe_cometance (groupe_cometance_source INT NOT NULL, groupe_cometance_target INT NOT NULL, INDEX IDX_8272CB506B928ACE (groupe_cometance_source), INDEX IDX_8272CB507277DA41 (groupe_cometance_target), PRIMARY KEY(groupe_cometance_source, groupe_cometance_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_cometance_referenciel (groupe_cometance_id INT NOT NULL, referenciel_id INT NOT NULL, INDEX IDX_8A526400D5C4C319 (groupe_cometance_id), INDEX IDX_8A52640022241379 (referenciel_id), PRIMARY KEY(groupe_cometance_id, referenciel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referenciel (id INT AUTO_INCREMENT NOT NULL, promo_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, presentation LONGTEXT NOT NULL, programme LONGBLOB NOT NULL, critair_evaluation VARCHAR(255) NOT NULL, criter_admission VARCHAR(255) NOT NULL, isdeleted TINYINT(1) NOT NULL, INDEX IDX_7AA24F0FD0C07AFF (promo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competance_competance ADD CONSTRAINT FK_BF4A22BCA6B069ED FOREIGN KEY (competance_source) REFERENCES competance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competance_competance ADD CONSTRAINT FK_BF4A22BCBF553962 FOREIGN KEY (competance_target) REFERENCES competance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_cometance_groupe_cometance ADD CONSTRAINT FK_8272CB506B928ACE FOREIGN KEY (groupe_cometance_source) REFERENCES groupe_cometance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_cometance_groupe_cometance ADD CONSTRAINT FK_8272CB507277DA41 FOREIGN KEY (groupe_cometance_target) REFERENCES groupe_cometance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_cometance_referenciel ADD CONSTRAINT FK_8A526400D5C4C319 FOREIGN KEY (groupe_cometance_id) REFERENCES groupe_cometance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_cometance_referenciel ADD CONSTRAINT FK_8A52640022241379 FOREIGN KEY (referenciel_id) REFERENCES referenciel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE referenciel ADD CONSTRAINT FK_7AA24F0FD0C07AFF FOREIGN KEY (promo_id) REFERENCES promo (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE groupe_cometance_groupe_cometance DROP FOREIGN KEY FK_8272CB506B928ACE');
        $this->addSql('ALTER TABLE groupe_cometance_groupe_cometance DROP FOREIGN KEY FK_8272CB507277DA41');
        $this->addSql('ALTER TABLE groupe_cometance_referenciel DROP FOREIGN KEY FK_8A526400D5C4C319');
        $this->addSql('ALTER TABLE groupe_cometance_referenciel DROP FOREIGN KEY FK_8A52640022241379');
        $this->addSql('DROP TABLE competance_competance');
        $this->addSql('DROP TABLE groupe_cometance');
        $this->addSql('DROP TABLE groupe_cometance_groupe_cometance');
        $this->addSql('DROP TABLE groupe_cometance_referenciel');
        $this->addSql('DROP TABLE referenciel');
    }
}
