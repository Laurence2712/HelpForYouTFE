<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200527080316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE requests ADD requester_id INT DEFAULT NULL, ADD firstname VARCHAR(60) NOT NULL');
        $this->addSql('ALTER TABLE requests ADD CONSTRAINT FK_7B85D651ED442CF4 FOREIGN KEY (requester_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_7B85D651ED442CF4 ON requests (requester_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE requests DROP FOREIGN KEY FK_7B85D651ED442CF4');
        $this->addSql('DROP INDEX IDX_7B85D651ED442CF4 ON requests');
        $this->addSql('ALTER TABLE requests DROP requester_id, DROP firstname');
    }
}
