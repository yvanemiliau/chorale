<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119082035 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre ADD voix_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB2948DF068D FOREIGN KEY (voix_id) REFERENCES voix (id)');
        $this->addSql('CREATE INDEX IDX_F6B4FB2948DF068D ON membre (voix_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB2948DF068D');
        $this->addSql('DROP INDEX IDX_F6B4FB2948DF068D ON membre');
        $this->addSql('ALTER TABLE membre DROP voix_id');
    }
}
