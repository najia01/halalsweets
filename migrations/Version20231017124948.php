<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231017124948 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sweets_sweets DROP FOREIGN KEY FK_12278737E375D856');
        $this->addSql('ALTER TABLE sweets_sweets DROP FOREIGN KEY FK_12278737FA9088D9');
        $this->addSql('DROP TABLE sweets_sweets');
        $this->addSql('ALTER TABLE orders_sweets DROP FOREIGN KEY FK_16AD494C3EEE31F6');
        $this->addSql('ALTER TABLE orders_sweets DROP FOREIGN KEY FK_16AD494CCAB4569B');
        $this->addSql('DROP INDEX IDX_16AD494CCAB4569B ON orders_sweets');
        $this->addSql('DROP INDEX IDX_16AD494C3EEE31F6 ON orders_sweets');
        $this->addSql('ALTER TABLE orders_sweets ADD order_id INT DEFAULT NULL, ADD sweet_id INT DEFAULT NULL, DROP sweet_id_id, DROP orders_id_id');
        $this->addSql('ALTER TABLE orders_sweets ADD CONSTRAINT FK_16AD494C8D9F6D38 FOREIGN KEY (order_id) REFERENCES orders (id)');
        $this->addSql('ALTER TABLE orders_sweets ADD CONSTRAINT FK_16AD494C1A84EA82 FOREIGN KEY (sweet_id) REFERENCES sweets (id)');
        $this->addSql('CREATE INDEX IDX_16AD494C8D9F6D38 ON orders_sweets (order_id)');
        $this->addSql('CREATE INDEX IDX_16AD494C1A84EA82 ON orders_sweets (sweet_id)');
        $this->addSql('ALTER TABLE sweets ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE sweets ADD CONSTRAINT FK_B73D709D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_B73D709D12469DE2 ON sweets (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sweets_sweets (sweets_source INT NOT NULL, sweets_target INT NOT NULL, INDEX IDX_12278737FA9088D9 (sweets_source), INDEX IDX_12278737E375D856 (sweets_target), PRIMARY KEY(sweets_source, sweets_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE sweets_sweets ADD CONSTRAINT FK_12278737E375D856 FOREIGN KEY (sweets_target) REFERENCES sweets (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sweets_sweets ADD CONSTRAINT FK_12278737FA9088D9 FOREIGN KEY (sweets_source) REFERENCES sweets (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sweets DROP FOREIGN KEY FK_B73D709D12469DE2');
        $this->addSql('DROP INDEX IDX_B73D709D12469DE2 ON sweets');
        $this->addSql('ALTER TABLE sweets DROP category_id');
        $this->addSql('ALTER TABLE orders_sweets DROP FOREIGN KEY FK_16AD494C8D9F6D38');
        $this->addSql('ALTER TABLE orders_sweets DROP FOREIGN KEY FK_16AD494C1A84EA82');
        $this->addSql('DROP INDEX IDX_16AD494C8D9F6D38 ON orders_sweets');
        $this->addSql('DROP INDEX IDX_16AD494C1A84EA82 ON orders_sweets');
        $this->addSql('ALTER TABLE orders_sweets ADD sweet_id_id INT DEFAULT NULL, ADD orders_id_id INT DEFAULT NULL, DROP order_id, DROP sweet_id');
        $this->addSql('ALTER TABLE orders_sweets ADD CONSTRAINT FK_16AD494C3EEE31F6 FOREIGN KEY (orders_id_id) REFERENCES sweets (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE orders_sweets ADD CONSTRAINT FK_16AD494CCAB4569B FOREIGN KEY (sweet_id_id) REFERENCES orders (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_16AD494CCAB4569B ON orders_sweets (sweet_id_id)');
        $this->addSql('CREATE INDEX IDX_16AD494C3EEE31F6 ON orders_sweets (orders_id_id)');
    }
}
