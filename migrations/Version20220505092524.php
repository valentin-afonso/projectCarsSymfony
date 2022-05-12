<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220505092524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE trailer_cars');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE trailer_cars (trailer_id INT NOT NULL, cars_id INT NOT NULL, INDEX IDX_22D22F09B6C04CFD (trailer_id), INDEX IDX_22D22F098702F506 (cars_id), PRIMARY KEY(trailer_id, cars_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE trailer_cars ADD CONSTRAINT FK_22D22F098702F506 FOREIGN KEY (cars_id) REFERENCES cars (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE trailer_cars ADD CONSTRAINT FK_22D22F09B6C04CFD FOREIGN KEY (trailer_id) REFERENCES trailer (id) ON DELETE CASCADE');
    }
}
