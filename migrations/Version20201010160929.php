<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201010160929 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX shipping_id ON customers');
        $this->addSql('ALTER TABLE customers ADD id INT AUTO_INCREMENT NOT NULL, CHANGE customer_id customer_id INT NOT NULL, CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE last_name last_name VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(40) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX order_id ON order_contents');
        $this->addSql('ALTER TABLE order_contents ADD id INT AUTO_INCREMENT NOT NULL, CHANGE content_id content_id INT NOT NULL, CHANGE quantity quantity VARCHAR(255) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('DROP INDEX shipping_id ON orders');
        $this->addSql('DROP INDEX address_id ON orders');
        $this->addSql('DROP INDEX customer_id ON orders');
        $this->addSql('ALTER TABLE orders ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE products ADD id INT AUTO_INCREMENT NOT NULL, CHANGE product_id product_id INT NOT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE artist artist VARCHAR(255) NOT NULL, CHANGE price price NUMERIC(4, 2) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE shipping ADD id INT AUTO_INCREMENT NOT NULL, CHANGE shipping_id shipping_id INT NOT NULL, CHANGE carrier carrier VARCHAR(255) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE shipping_address ADD id INT AUTO_INCREMENT NOT NULL, CHANGE city city VARCHAR(50) NOT NULL, CHANGE phone phone VARCHAR(20) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE states ADD id INT AUTO_INCREMENT NOT NULL, CHANGE state_id state_id BIGINT NOT NULL, CHANGE code code VARCHAR(2) NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customers MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE customers DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE customers DROP id, CHANGE customer_id customer_id INT AUTO_INCREMENT NOT NULL, CHANGE first_name first_name VARCHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, CHANGE last_name last_name VARCHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, CHANGE email email VARCHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, CHANGE password password CHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`');
        $this->addSql('CREATE INDEX shipping_id ON customers (address_id)');
        $this->addSql('ALTER TABLE customers ADD PRIMARY KEY (customer_id)');
        $this->addSql('ALTER TABLE order_contents MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE order_contents DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE order_contents DROP id, CHANGE content_id content_id INT AUTO_INCREMENT NOT NULL, CHANGE quantity quantity INT NOT NULL');
        $this->addSql('CREATE INDEX order_id ON order_contents (order_id)');
        $this->addSql('ALTER TABLE order_contents ADD PRIMARY KEY (content_id)');
        $this->addSql('ALTER TABLE orders MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE orders DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE orders DROP id');
        $this->addSql('CREATE INDEX shipping_id ON orders (shipping_id)');
        $this->addSql('CREATE INDEX address_id ON orders (address_id)');
        $this->addSql('CREATE INDEX customer_id ON orders (customer_id)');
        $this->addSql('ALTER TABLE orders ADD PRIMARY KEY (order_id)');
        $this->addSql('ALTER TABLE products MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE products DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE products DROP id, CHANGE product_id product_id INT AUTO_INCREMENT NOT NULL, CHANGE title title VARCHAR(50) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, CHANGE artist artist VARCHAR(40) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, CHANGE price price NUMERIC(5, 2) NOT NULL, CHANGE image image VARCHAR(25) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`');
        $this->addSql('ALTER TABLE products ADD PRIMARY KEY (product_id)');
        $this->addSql('ALTER TABLE shipping MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE shipping DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE shipping DROP id, CHANGE shipping_id shipping_id INT AUTO_INCREMENT NOT NULL, CHANGE carrier carrier VARCHAR(25) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`');
        $this->addSql('ALTER TABLE shipping ADD PRIMARY KEY (shipping_id)');
        $this->addSql('ALTER TABLE shipping_address MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE shipping_address DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE shipping_address DROP id, CHANGE city city VARCHAR(30) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`, CHANGE phone phone VARCHAR(15) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`');
        $this->addSql('ALTER TABLE shipping_address ADD PRIMARY KEY (address_id)');
        $this->addSql('ALTER TABLE states MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE states DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE states DROP id, CHANGE state_id state_id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE code code CHAR(2) CHARACTER SET utf16 NOT NULL COLLATE `utf16_general_ci`');
        $this->addSql('ALTER TABLE states ADD PRIMARY KEY (state_id)');
    }
}
