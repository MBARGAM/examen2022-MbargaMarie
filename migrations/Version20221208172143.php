<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221208172143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE chanson (id INT AUTO_INCREMENT NOT NULL, genre_id INT NOT NULL, titre VARCHAR(255) NOT NULL, nom_album VARCHAR(255) NOT NULL, paroles LONGTEXT NOT NULL, auteur VARCHAR(255) NOT NULL, votes INT DEFAULT NULL, date_ajout DATE NOT NULL, date_sortie DATE NOT NULL, INDEX IDX_A2E637C24296D31F (genre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE chanson ADD CONSTRAINT FK_A2E637C24296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE chanson');
    }
}
