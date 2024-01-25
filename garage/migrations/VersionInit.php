<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class VersionInit extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Initial migration';
    }

    public function up(Schema $schema): void
    {
        // Create tables
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, year INT NOT NULL, description LONGTEXT DEFAULT NULL, km DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, subject VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, submitted_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opening_hour (id INT AUTO_INCREMENT NOT NULL, day VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_969BD765E5A02990 (day), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, note INT NOT NULL, submitted_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', processed TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');

        // Populate service table
        $this->addSql('INSERT INTO service (name, description) VALUES ("Réparation Mécanique", "Réparation et entretien des composants mécaniques des voitures, assurant leur bon fonctionnement et leur fiabilité")');
        $this->addSql('INSERT INTO service (name, description) VALUES ("Entretien Régulier", "Service d\'entretien régulier pour maintenir la performance et la sécurité des véhicules, incluant les vérifications d\'usage et les remplacements nécessaires")');
        $this->addSql('INSERT INTO service (name, description) VALUES ("Réparation de Carrosserie", "Service spécialisé dans la réparation de la carrosserie des voitures, garantissant un retour à l\'état optimal de la structure extérieure du véhicule")');
        $this->addSql('INSERT INTO service (name, description) VALUES ("Vente de véhicules d\'occasion", "Service de vente de véhicules d\'occasion, incluant la révision et la garantie de bon fonctionnement")');
        // Populate opening_hour table
        $this->addSql('INSERT INTO opening_hour (day, id, value) VALUES ("Lundi", 1, "08:45 - 12:00 , 14:00 - 18:00"), ("Mardi", 2, "08:45 - 12:00 , 14:00 - 18:00"), ("Mercredi", 3, "08:45 - 12:00 , 14:00 - 18:00"), ("Jeudi", 4, "08:45 - 12:00 , 14:00 - 18:00"), ("Vendredi", 5, "08:45 - 12:00 , 14:00 - 18:00"), ("Samedi", 6, "08:45 - 12:00 - fermé - fermé"), ("Dimanche", 7, "fermé")');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE opening_hour');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
