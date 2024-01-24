<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119172655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD book_user_id UUID NOT NULL');
        $this->addSql('COMMENT ON COLUMN book.book_user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331344EFB03 FOREIGN KEY (book_user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CBE5A331344EFB03 ON book (book_user_id)');
        $this->addSql('ALTER TABLE "user" DROP plain_password');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP CONSTRAINT FK_CBE5A331344EFB03');
        $this->addSql('DROP INDEX IDX_CBE5A331344EFB03');
        $this->addSql('ALTER TABLE book DROP book_user_id');
        $this->addSql('ALTER TABLE "user" ADD plain_password VARCHAR(255) DEFAULT NULL');
    }
}
