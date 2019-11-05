<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190118215853 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE order_detail (id INT AUTO_INCREMENT NOT NULL, orderid INT DEFAULT NULL, userid INT DEFAULT NULL, productid INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, quantity INT DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, name VARCHAR(150) DEFAULT NULL, status VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, userid INT DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, name VARCHAR(50) DEFAULT NULL, adress VARCHAR(150) DEFAULT NULL, city VARCHAR(20) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, shipinfo VARCHAR(255) DEFAULT NULL, status VARCHAR(15) DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users CHANGE name name VARCHAR(20) NOT NULL, CHANGE email email VARCHAR(30) NOT NULL, CHANGE password password VARCHAR(100) NOT NULL, CHANGE status status VARCHAR(10) NOT NULL, CHANGE type type VARCHAR(10) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE order_detail');
        $this->addSql('DROP TABLE orders');
        $this->addSql('ALTER TABLE users CHANGE name name VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(30) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE password password VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE status status VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE type type VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE created_at created_at DATETIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }
}
