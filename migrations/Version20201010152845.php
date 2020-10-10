<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201010152845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE customers');
        $this->addSql('DROP TABLE order_contents');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE shipping');
        $this->addSql('DROP TABLE shipping_address');
        $this->addSql('DROP TABLE states');
        $this->addSql('ALTER TABLE products ADD id INT AUTO_INCREMENT NOT NULL, CHANGE product_id product_id INT NOT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE artist artist VARCHAR(255) NOT NULL, CHANGE price price NUMERIC(4, 2) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE customers (customer_id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, last_name VARCHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, email VARCHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, password CHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, address_id INT NOT NULL, reg_date DATETIME NOT NULL, INDEX shipping_id (address_id), PRIMARY KEY(customer_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE order_contents (content_id INT AUTO_INCREMENT NOT NULL, order_id INT NOT NULL, product_id INT NOT NULL, quantity INT NOT NULL, INDEX order_id (order_id), PRIMARY KEY(content_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE orders (order_id INT NOT NULL, customer_id INT NOT NULL, order_date DATETIME NOT NULL, total NUMERIC(5, 2) NOT NULL, shipping_id INT NOT NULL, address_id INT NOT NULL, INDEX shipping_id (shipping_id), INDEX address_id (address_id), INDEX customer_id (customer_id), PRIMARY KEY(order_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE shipping (shipping_id INT AUTO_INCREMENT NOT NULL, carrier VARCHAR(25) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, cost NUMERIC(5, 2) NOT NULL, PRIMARY KEY(shipping_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE shipping_address (address_id INT NOT NULL, order_id INT NOT NULL, ship_name VARCHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, address VARCHAR(50) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, address2 VARCHAR(50) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, city VARCHAR(30) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, state VARCHAR(2) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, zip INT NOT NULL, phone VARCHAR(15) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, PRIMARY KEY(address_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE states (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, code CHAR(2) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, name VARCHAR(64) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE products MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE products DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE products DROP id, CHANGE product_id product_id INT AUTO_INCREMENT NOT NULL, CHANGE title title VARCHAR(50) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, CHANGE artist artist VARCHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, CHANGE price price NUMERIC(5, 2) NOT NULL, CHANGE image image VARCHAR(25) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`');
        $this->addSql('ALTER TABLE products ADD PRIMARY KEY (product_id)');
    }
}
