<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604210153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE eav_attribute (id INT AUTO_INCREMENT NOT NULL, entity_type_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_EDA4B1885681BEB0 (entity_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eav_attribute_value (id INT AUTO_INCREMENT NOT NULL, attribute_id INT DEFAULT NULL, value_string VARCHAR(255) DEFAULT NULL, value_date DATETIME DEFAULT NULL, value_int INT DEFAULT NULL, value_bool TINYINT(1) DEFAULT NULL, INDEX IDX_2B38CE18B6E62EFA (attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eav_entity (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, INDEX IDX_9F14D627C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eav_entity_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE eav_attribute ADD CONSTRAINT FK_EDA4B1885681BEB0 FOREIGN KEY (entity_type_id) REFERENCES eav_entity_type (id)');
        $this->addSql('ALTER TABLE eav_attribute_value ADD CONSTRAINT FK_2B38CE18B6E62EFA FOREIGN KEY (attribute_id) REFERENCES eav_attribute (id)');
        $this->addSql('ALTER TABLE eav_entity ADD CONSTRAINT FK_9F14D627C54C8C93 FOREIGN KEY (type_id) REFERENCES eav_entity_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eav_attribute_value DROP FOREIGN KEY FK_2B38CE18B6E62EFA');
        $this->addSql('ALTER TABLE eav_attribute DROP FOREIGN KEY FK_EDA4B1885681BEB0');
        $this->addSql('ALTER TABLE eav_entity DROP FOREIGN KEY FK_9F14D627C54C8C93');
        $this->addSql('DROP TABLE eav_attribute');
        $this->addSql('DROP TABLE eav_attribute_value');
        $this->addSql('DROP TABLE eav_entity');
        $this->addSql('DROP TABLE eav_entity_type');
    }
}
