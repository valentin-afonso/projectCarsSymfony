<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505091751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, couleur VARCHAR(255) NOT NULL, nb_place VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_95C71D147975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cars_trailer (cars_id INT NOT NULL, trailer_id INT NOT NULL, INDEX IDX_592A79808702F506 (cars_id), INDEX IDX_592A7980B6C04CFD (trailer_id), PRIMARY KEY(cars_id, trailer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE purchase (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, cars_id INT DEFAULT NULL, date DATETIME NOT NULL, INDEX IDX_6117D13BA76ED395 (user_id), INDEX IDX_6117D13B8702F506 (cars_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trailer (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trailer_cars (trailer_id INT NOT NULL, cars_id INT NOT NULL, INDEX IDX_22D22F09B6C04CFD (trailer_id), INDEX IDX_22D22F098702F506 (cars_id), PRIMARY KEY(trailer_id, cars_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, age INT NOT NULL, ville VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D147975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE cars_trailer ADD CONSTRAINT FK_592A79808702F506 FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cars_trailer ADD CONSTRAINT FK_592A7980B6C04CFD FOREIGN KEY (trailer_id) REFERENCES trailer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B8702F506 FOREIGN KEY (cars_id) REFERENCES cars (id)');
        $this->addSql('ALTER TABLE trailer_cars ADD CONSTRAINT FK_22D22F09B6C04CFD FOREIGN KEY (trailer_id) REFERENCES trailer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trailer_cars ADD CONSTRAINT FK_22D22F098702F506 FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars_trailer DROP FOREIGN KEY FK_592A79808702F506');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B8702F506');
        $this->addSql('ALTER TABLE trailer_cars DROP FOREIGN KEY FK_22D22F098702F506');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D147975B7E7');
        $this->addSql('ALTER TABLE cars_trailer DROP FOREIGN KEY FK_592A7980B6C04CFD');
        $this->addSql('ALTER TABLE trailer_cars DROP FOREIGN KEY FK_22D22F09B6C04CFD');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BA76ED395');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE cars_trailer');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE purchase');
        $this->addSql('DROP TABLE trailer');
        $this->addSql('DROP TABLE trailer_cars');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
