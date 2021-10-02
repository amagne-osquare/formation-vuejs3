<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211001210836 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE product_comment_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_variant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_comment (id INT NOT NULL, product_id INT NOT NULL, author VARCHAR(255) NOT NULL, comment TEXT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, note SMALLINT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_45AD49DC4584665A ON product_comment (product_id)');
        $this->addSql('CREATE TABLE product_variant (id INT NOT NULL, product_id INT NOT NULL, value VARCHAR(255) NOT NULL, qty_in_stock SMALLINT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_209AA41D4584665A ON product_variant (product_id)');
        $this->addSql('ALTER TABLE product_comment ADD CONSTRAINT FK_45AD49DC4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_variant ADD CONSTRAINT FK_209AA41D4584665A FOREIGN KEY (product_id) REFERENCES product (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE product_comment_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_variant_id_seq CASCADE');
        $this->addSql('DROP TABLE product_comment');
        $this->addSql('DROP TABLE product_variant');
    }
}
