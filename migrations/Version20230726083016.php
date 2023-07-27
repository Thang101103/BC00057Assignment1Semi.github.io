<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230726083016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE categogy');
        $this->addSql('ALTER TABLE `order` CHANGE customer_phone customer_phone VARCHAR(12) NOT NULL, CHANGE total_price total_price DOUBLE PRECISION NOT NULL, CHANGE status status TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE order_item ADD o_id INT NOT NULL, ADD item_id INT NOT NULL, DROP item, CHANGE quantity quantity INT NOT NULL, CHANGE price price DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09DB01246B FOREIGN KEY (o_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09126F525E FOREIGN KEY (item_id) REFERENCES san_pham (id)');
        $this->addSql('CREATE INDEX IDX_52EA1F09DB01246B ON order_item (o_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F09126F525E ON order_item (item_id)');
        $this->addSql('ALTER TABLE san_pham ADD cate_id INT DEFAULT NULL, CHANGE name name VARCHAR(200) NOT NULL, CHANGE price price DOUBLE PRECISION NOT NULL, CHANGE photo photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE san_pham ADD CONSTRAINT FK_809F457C7D3008E5 FOREIGN KEY (cate_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_809F457C7D3008E5 ON san_pham (cate_id)');
        $this->addSql('ALTER TABLE user ADD roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', CHANGE username username VARCHAR(180) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE first_name first_name VARCHAR(50) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE san_pham DROP FOREIGN KEY FK_809F457C7D3008E5');
        $this->addSql('CREATE TABLE categogy (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, sanphams VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE category');
        $this->addSql('ALTER TABLE `order` CHANGE customer_phone customer_phone VARCHAR(255) NOT NULL, CHANGE total_price total_price VARCHAR(255) NOT NULL, CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F09DB01246B');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F09126F525E');
        $this->addSql('DROP INDEX IDX_52EA1F09DB01246B ON order_item');
        $this->addSql('DROP INDEX IDX_52EA1F09126F525E ON order_item');
        $this->addSql('ALTER TABLE order_item ADD item VARCHAR(255) NOT NULL, DROP o_id, DROP item_id, CHANGE quantity quantity VARCHAR(255) NOT NULL, CHANGE price price VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX IDX_809F457C7D3008E5 ON san_pham');
        $this->addSql('ALTER TABLE san_pham DROP cate_id, CHANGE name name VARCHAR(100) NOT NULL, CHANGE price price VARCHAR(50) DEFAULT NULL, CHANGE photo photo VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('ALTER TABLE user DROP roles, CHANGE username username VARCHAR(100) NOT NULL, CHANGE password password VARCHAR(50) NOT NULL, CHANGE first_name first_name VARCHAR(100) NOT NULL');
    }
}
