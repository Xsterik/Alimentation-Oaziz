<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220510153111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE aliments (id INT AUTO_INCREMENT NOT NULL, category_aliments_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, protein DOUBLE PRECISION NOT NULL, carbohydrate DOUBLE PRECISION NOT NULL, lipid DOUBLE PRECISION NOT NULL, INDEX IDX_B7C2C9DC3A1B8423 (category_aliments_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_aliments (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE micronutrients (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE micronutrients_aliments (micronutrients_id INT NOT NULL, aliments_id INT NOT NULL, INDEX IDX_20404C8A9AA2BD50 (micronutrients_id), INDEX IDX_20404C8A8D80C648 (aliments_id), PRIMARY KEY(micronutrients_id, aliments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE aliments ADD CONSTRAINT FK_B7C2C9DC3A1B8423 FOREIGN KEY (category_aliments_id) REFERENCES category_aliments (id)');
        $this->addSql('ALTER TABLE micronutrients_aliments ADD CONSTRAINT FK_20404C8A9AA2BD50 FOREIGN KEY (micronutrients_id) REFERENCES micronutrients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE micronutrients_aliments ADD CONSTRAINT FK_20404C8A8D80C648 FOREIGN KEY (aliments_id) REFERENCES aliments (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE micronutrients_aliments DROP FOREIGN KEY FK_20404C8A8D80C648');
        $this->addSql('ALTER TABLE aliments DROP FOREIGN KEY FK_B7C2C9DC3A1B8423');
        $this->addSql('ALTER TABLE micronutrients_aliments DROP FOREIGN KEY FK_20404C8A9AA2BD50');
        $this->addSql('DROP TABLE aliments');
        $this->addSql('DROP TABLE category_aliments');
        $this->addSql('DROP TABLE micronutrients');
        $this->addSql('DROP TABLE micronutrients_aliments');
    }
}
