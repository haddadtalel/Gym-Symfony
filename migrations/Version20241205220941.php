<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241205220941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classes (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(100) NOT NULL, capacity INT NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes_instructors (classes_id INT NOT NULL, instructors_id INT NOT NULL, INDEX IDX_3559576D9E225B24 (classes_id), INDEX IDX_3559576D8EFB301A (instructors_id), PRIMARY KEY(classes_id, instructors_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE classes_equipments (classes_id INT NOT NULL, equipments_id INT NOT NULL, INDEX IDX_BD0581E49E225B24 (classes_id), INDEX IDX_BD0581E4BD251DD7 (equipments_id), PRIMARY KEY(classes_id, equipments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipments (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, type VARCHAR(100) NOT NULL, eqcondition VARCHAR(100) NOT NULL, last_maint_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipments_classes (equipments_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_22A36A29BD251DD7 (equipments_id), INDEX IDX_22A36A299E225B24 (classes_id), PRIMARY KEY(equipments_id, classes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback (id INT AUTO_INCREMENT NOT NULL, class_id INT NOT NULL, username VARCHAR(100) DEFAULT NULL, rating INT NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_D2294458EA000B10 (class_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instructors (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, spec VARCHAR(100) NOT NULL, bio LONGTEXT DEFAULT NULL, phone_number INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nutrition_plans (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, meal_detail LONGTEXT DEFAULT NULL, calories INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, INDEX IDX_5C4A60C1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pack (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(100) NOT NULL, duration VARCHAR(100) NOT NULL, amount INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedules (id INT AUTO_INCREMENT NOT NULL, start_time DATETIME NOT NULL, end_time DATETIME NOT NULL, room VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedules_classes (schedules_id INT NOT NULL, classes_id INT NOT NULL, INDEX IDX_AE8B0739116C90BC (schedules_id), INDEX IDX_AE8B07399E225B24 (classes_id), PRIMARY KEY(schedules_id, classes_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscription (id INT AUTO_INCREMENT NOT NULL, pack_id INT NOT NULL, user_id INT NOT NULL, description LONGTEXT DEFAULT NULL, status TINYINT(1) NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, payment_method VARCHAR(100) NOT NULL, INDEX IDX_A3C664D31919B217 (pack_id), INDEX IDX_A3C664D3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, sub_id_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, phone INT DEFAULT NULL, adress VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D6499300FAEE (sub_id_id), UNIQUE INDEX UNIQ_IDENTIFIER_USERNAME (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE classes_instructors ADD CONSTRAINT FK_3559576D9E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classes_instructors ADD CONSTRAINT FK_3559576D8EFB301A FOREIGN KEY (instructors_id) REFERENCES instructors (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classes_equipments ADD CONSTRAINT FK_BD0581E49E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classes_equipments ADD CONSTRAINT FK_BD0581E4BD251DD7 FOREIGN KEY (equipments_id) REFERENCES equipments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipments_classes ADD CONSTRAINT FK_22A36A29BD251DD7 FOREIGN KEY (equipments_id) REFERENCES equipments (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipments_classes ADD CONSTRAINT FK_22A36A299E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458EA000B10 FOREIGN KEY (class_id) REFERENCES classes (id)');
        $this->addSql('ALTER TABLE nutrition_plans ADD CONSTRAINT FK_5C4A60C1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE schedules_classes ADD CONSTRAINT FK_AE8B0739116C90BC FOREIGN KEY (schedules_id) REFERENCES schedules (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE schedules_classes ADD CONSTRAINT FK_AE8B07399E225B24 FOREIGN KEY (classes_id) REFERENCES classes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D31919B217 FOREIGN KEY (pack_id) REFERENCES pack (id)');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499300FAEE FOREIGN KEY (sub_id_id) REFERENCES subscription (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE classes_instructors DROP FOREIGN KEY FK_3559576D9E225B24');
        $this->addSql('ALTER TABLE classes_instructors DROP FOREIGN KEY FK_3559576D8EFB301A');
        $this->addSql('ALTER TABLE classes_equipments DROP FOREIGN KEY FK_BD0581E49E225B24');
        $this->addSql('ALTER TABLE classes_equipments DROP FOREIGN KEY FK_BD0581E4BD251DD7');
        $this->addSql('ALTER TABLE equipments_classes DROP FOREIGN KEY FK_22A36A29BD251DD7');
        $this->addSql('ALTER TABLE equipments_classes DROP FOREIGN KEY FK_22A36A299E225B24');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458EA000B10');
        $this->addSql('ALTER TABLE nutrition_plans DROP FOREIGN KEY FK_5C4A60C1A76ED395');
        $this->addSql('ALTER TABLE schedules_classes DROP FOREIGN KEY FK_AE8B0739116C90BC');
        $this->addSql('ALTER TABLE schedules_classes DROP FOREIGN KEY FK_AE8B07399E225B24');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D31919B217');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499300FAEE');
        $this->addSql('DROP TABLE classes');
        $this->addSql('DROP TABLE classes_instructors');
        $this->addSql('DROP TABLE classes_equipments');
        $this->addSql('DROP TABLE equipments');
        $this->addSql('DROP TABLE equipments_classes');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE instructors');
        $this->addSql('DROP TABLE nutrition_plans');
        $this->addSql('DROP TABLE pack');
        $this->addSql('DROP TABLE schedules');
        $this->addSql('DROP TABLE schedules_classes');
        $this->addSql('DROP TABLE subscription');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
