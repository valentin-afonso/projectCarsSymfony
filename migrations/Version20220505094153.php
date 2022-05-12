<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505094153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cars_trailer DROP FOREIGN KEY FK_592A79808702F506');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13B8702F506');
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, couleur VARCHAR(255) NOT NULL, nb_place VARCHAR(255) NOT NULL, prix DOUBLE PRECISION NOT NULL, INDEX IDX_773DE69D7975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car_trailer (car_id INT NOT NULL, trailer_id INT NOT NULL, INDEX IDX_953A2792C3C6F69F (car_id), INDEX IDX_953A2792B6C04CFD (trailer_id), PRIMARY KEY(car_id, trailer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69D7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE car_trailer ADD CONSTRAINT FK_953A2792C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE car_trailer ADD CONSTRAINT FK_953A2792B6C04CFD FOREIGN KEY (trailer_id) REFERENCES trailer (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE cars_trailer');
        $this->addSql('DROP INDEX IDX_6117D13B8702F506 ON purchase');
        $this->addSql('ALTER TABLE purchase CHANGE cars_id car_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13BC3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE INDEX IDX_6117D13BC3C6F69F ON purchase (car_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE car_trailer DROP FOREIGN KEY FK_953A2792C3C6F69F');
        $this->addSql('ALTER TABLE purchase DROP FOREIGN KEY FK_6117D13BC3C6F69F');
        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, model_id INT NOT NULL, couleur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nb_place VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prix DOUBLE PRECISION NOT NULL, INDEX IDX_95C71D147975B7E7 (model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE cars_trailer (cars_id INT NOT NULL, trailer_id INT NOT NULL, INDEX IDX_592A79808702F506 (cars_id), INDEX IDX_592A7980B6C04CFD (trailer_id), PRIMARY KEY(cars_id, trailer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D147975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE cars_trailer ADD CONSTRAINT FK_592A79808702F506 FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cars_trailer ADD CONSTRAINT FK_592A7980B6C04CFD FOREIGN KEY (trailer_id) REFERENCES trailer (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE car_trailer');
        $this->addSql('DROP INDEX IDX_6117D13BC3C6F69F ON purchase');
        $this->addSql('ALTER TABLE purchase CHANGE car_id cars_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE purchase ADD CONSTRAINT FK_6117D13B8702F506 FOREIGN KEY (cars_id) REFERENCES cars (id)');
        $this->addSql('CREATE INDEX IDX_6117D13B8702F506 ON purchase (cars_id)');
    }
}
