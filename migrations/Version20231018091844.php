<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231018091844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, total INT NOT NULL, INDEX IDX_BA388B79D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_sweets (cart_id INT NOT NULL, sweets_id INT NOT NULL, INDEX IDX_B9B912C21AD5CDBF (cart_id), INDEX IDX_B9B912C2E4DDDBC3 (sweets_id), PRIMARY KEY(cart_id, sweets_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B79D86650F FOREIGN KEY (user_id_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE cart_sweets ADD CONSTRAINT FK_B9B912C21AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_sweets ADD CONSTRAINT FK_B9B912C2E4DDDBC3 FOREIGN KEY (sweets_id) REFERENCES sweets (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B79D86650F');
        $this->addSql('ALTER TABLE cart_sweets DROP FOREIGN KEY FK_B9B912C21AD5CDBF');
        $this->addSql('ALTER TABLE cart_sweets DROP FOREIGN KEY FK_B9B912C2E4DDDBC3');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_sweets');
    }
}
