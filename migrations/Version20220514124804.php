<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220514124804 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aliments ADD description LONGTEXT NOT NULL, ADD image VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE catergory_micronutrients ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE micronutrients ADD description LONGTEXT NOT NULL, ADD bienfaits LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aliments DROP description, DROP image');
        $this->addSql('ALTER TABLE catergory_micronutrients DROP description');
        $this->addSql('ALTER TABLE micronutrients DROP description, DROP bienfaits');
    }
}
