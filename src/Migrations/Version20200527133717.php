<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200527133717 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment ADD commentator_id INT DEFAULT NULL, ADD commented_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C506AFCC0 FOREIGN KEY (commentator_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CC1A7A1A1 FOREIGN KEY (commented_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_9474526C506AFCC0 ON comment (commentator_id)');
        $this->addSql('CREATE INDEX IDX_9474526CC1A7A1A1 ON comment (commented_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C506AFCC0');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CC1A7A1A1');
        $this->addSql('DROP INDEX IDX_9474526C506AFCC0 ON comment');
        $this->addSql('DROP INDEX IDX_9474526CC1A7A1A1 ON comment');
        $this->addSql('ALTER TABLE comment DROP commentator_id, DROP commented_id');
    }
}
