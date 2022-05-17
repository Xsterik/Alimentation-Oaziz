<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220512090148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE micronutrients ADD category_id INT DEFAULT NULL, DROP type');
        $this->addSql('ALTER TABLE micronutrients ADD CONSTRAINT FK_CC84A95712469DE2 FOREIGN KEY (category_id) REFERENCES catergory_micronutrients (id)');
        $this->addSql('CREATE INDEX IDX_CC84A95712469DE2 ON micronutrients (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE micronutrients DROP FOREIGN KEY FK_CC84A95712469DE2');
        $this->addSql('DROP INDEX IDX_CC84A95712469DE2 ON micronutrients');
        $this->addSql('ALTER TABLE micronutrients ADD type VARCHAR(255) NOT NULL, DROP category_id');
    }
}
