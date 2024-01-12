<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123100734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP CONSTRAINT fk_cbe5a33169ccbe9a');
        $this->addSql('ALTER TABLE book DROP CONSTRAINT fk_cbe5a3318aaa43d0');
        $this->addSql('DROP INDEX idx_cbe5a3318aaa43d0');
        $this->addSql('DROP INDEX idx_cbe5a33169ccbe9a');
        $this->addSql('ALTER TABLE book ADD author_id UUID NOT NULL');
        $this->addSql('ALTER TABLE book ADD publisher_id UUID NOT NULL');
        $this->addSql('ALTER TABLE book DROP author_id_id');
        $this->addSql('ALTER TABLE book DROP publisher_id_id');
        $this->addSql('COMMENT ON COLUMN book.author_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN book.publisher_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331F675F31B FOREIGN KEY (author_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33140C86FCE FOREIGN KEY (publisher_id) REFERENCES publisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_CBE5A331F675F31B ON book (author_id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33140C86FCE ON book (publisher_id)');
        $this->addSql('ALTER TABLE "user" ALTER username TYPE VARCHAR(180)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP CONSTRAINT FK_CBE5A331F675F31B');
        $this->addSql('ALTER TABLE book DROP CONSTRAINT FK_CBE5A33140C86FCE');
        $this->addSql('DROP INDEX IDX_CBE5A331F675F31B');
        $this->addSql('DROP INDEX IDX_CBE5A33140C86FCE');
        $this->addSql('ALTER TABLE book ADD author_id_id UUID NOT NULL');
        $this->addSql('ALTER TABLE book ADD publisher_id_id UUID NOT NULL');
        $this->addSql('ALTER TABLE book DROP author_id');
        $this->addSql('ALTER TABLE book DROP publisher_id');
        $this->addSql('COMMENT ON COLUMN book.author_id_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN book.publisher_id_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT fk_cbe5a33169ccbe9a FOREIGN KEY (author_id_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT fk_cbe5a3318aaa43d0 FOREIGN KEY (publisher_id_id) REFERENCES publisher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_cbe5a3318aaa43d0 ON book (publisher_id_id)');
        $this->addSql('CREATE INDEX idx_cbe5a33169ccbe9a ON book (author_id_id)');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677');
        $this->addSql('ALTER TABLE "user" ALTER username TYPE VARCHAR(255)');
    }
}
