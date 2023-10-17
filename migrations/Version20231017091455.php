<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231017091455 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category_sweets (category_id INT NOT NULL, sweets_id INT NOT NULL, INDEX IDX_B8D5BAE612469DE2 (category_id), INDEX IDX_B8D5BAE6E4DDDBC3 (sweets_id), PRIMARY KEY(category_id, sweets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, uid_id INT NOT NULL, total_price INT NOT NULL, INDEX IDX_E52FFDEE534B549B (uid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders_sweets (id INT AUTO_INCREMENT NOT NULL, sweet_id_id INT DEFAULT NULL, orders_id_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_16AD494CCAB4569B (sweet_id_id), INDEX IDX_16AD494C3EEE31F6 (orders_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sweets (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, thumbnail VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sweets_sweets (sweets_source INT NOT NULL, sweets_target INT NOT NULL, INDEX IDX_12278737FA9088D9 (sweets_source), INDEX IDX_12278737E375D856 (sweets_target), PRIMARY KEY(sweets_source, sweets_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, adress VARCHAR(255) NOT NULL, zipcode VARCHAR(5) NOT NULL, city VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category_sweets ADD CONSTRAINT FK_B8D5BAE612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_sweets ADD CONSTRAINT FK_B8D5BAE6E4DDDBC3 FOREIGN KEY (sweets_id) REFERENCES sweets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE534B549B FOREIGN KEY (uid_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE orders_sweets ADD CONSTRAINT FK_16AD494CCAB4569B FOREIGN KEY (sweet_id_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_sweets ADD CONSTRAINT FK_16AD494C3EEE31F6 FOREIGN KEY (orders_id_id) REFERENCES sweets (id)');
        $this->addSql('ALTER TABLE sweets_sweets ADD CONSTRAINT FK_12278737FA9088D9 FOREIGN KEY (sweets_source) REFERENCES sweets (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sweets_sweets ADD CONSTRAINT FK_12278737E375D856 FOREIGN KEY (sweets_target) REFERENCES sweets (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_sweets DROP FOREIGN KEY FK_B8D5BAE612469DE2');
        $this->addSql('ALTER TABLE category_sweets DROP FOREIGN KEY FK_B8D5BAE6E4DDDBC3');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE534B549B');
        $this->addSql('ALTER TABLE orders_sweets DROP FOREIGN KEY FK_16AD494CCAB4569B');
        $this->addSql('ALTER TABLE orders_sweets DROP FOREIGN KEY FK_16AD494C3EEE31F6');
        $this->addSql('ALTER TABLE sweets_sweets DROP FOREIGN KEY FK_12278737FA9088D9');
        $this->addSql('ALTER TABLE sweets_sweets DROP FOREIGN KEY FK_12278737E375D856');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE category_sweets');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE orders_sweets');
        $this->addSql('DROP TABLE sweets');
        $this->addSql('DROP TABLE sweets_sweets');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
