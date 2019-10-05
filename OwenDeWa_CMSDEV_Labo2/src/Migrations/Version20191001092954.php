<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191001092954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE camps (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, quote VARCHAR(255) NOT NULL, date DATETIME NOT NULL, image VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, watch TINYINT(1) NOT NULL, likes INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reactions (id INT AUTO_INCREMENT NOT NULL, camp_id_id INT NOT NULL, content LONGTEXT NOT NULL, date DATETIME NOT NULL, UNIQUE INDEX UNIQ_38737FB3717AF4CB (camp_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reactions ADD CONSTRAINT FK_38737FB3717AF4CB FOREIGN KEY (camp_id_id) REFERENCES camps (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE reactions DROP FOREIGN KEY FK_38737FB3717AF4CB');
        $this->addSql('DROP TABLE camps');
        $this->addSql('DROP TABLE reactions');
    }
}
