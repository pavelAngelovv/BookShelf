<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240105135823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_author (book_id UUID NOT NULL, author_id UUID NOT NULL, PRIMARY KEY(book_id, author_id))');
        $this->addSql('CREATE INDEX IDX_9478D34516A2B381 ON book_author (book_id)');
        $this->addSql('CREATE INDEX IDX_9478D345F675F31B ON book_author (author_id)');
        $this->addSql('COMMENT ON COLUMN book_author.book_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN book_author.author_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book_author ADD CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book DROP CONSTRAINT fk_cbe5a331f675f31b');
        $this->addSql('DROP INDEX idx_cbe5a331f675f31b');
        $this->addSql('ALTER TABLE book DROP author_id');
        $this->addSql('ALTER TABLE book ALTER publisher_id DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book_author DROP CONSTRAINT FK_9478D34516A2B381');
        $this->addSql('ALTER TABLE book_author DROP CONSTRAINT FK_9478D345F675F31B');
        $this->addSql('DROP TABLE book_author');
        $this->addSql('ALTER TABLE book ADD author_id UUID NOT NULL');
        $this->addSql('ALTER TABLE book ALTER publisher_id SET NOT NULL');
        $this->addSql('COMMENT ON COLUMN book.author_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT fk_cbe5a331f675f31b FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_cbe5a331f675f31b ON book (author_id)');
    }
}
