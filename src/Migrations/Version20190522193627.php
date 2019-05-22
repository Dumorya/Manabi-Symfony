<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190522193627 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE word DROP FOREIGN KEY FK_C3F17511E01659A3');
        $this->addSql('DROP INDEX IDX_C3F17511E01659A3 ON word');
        $this->addSql('ALTER TABLE word CHANGE words_list_id_id words_list_id INT NOT NULL');
        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F1751199D5790 FOREIGN KEY (words_list_id) REFERENCES words_list (id)');
        $this->addSql('CREATE INDEX IDX_C3F1751199D5790 ON word (words_list_id)');
        $this->addSql('ALTER TABLE words_list DROP FOREIGN KEY FK_B73046889D86650F');
        $this->addSql('DROP INDEX IDX_B73046889D86650F ON words_list');
        $this->addSql('ALTER TABLE words_list CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE words_list ADD CONSTRAINT FK_B7304688A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B7304688A76ED395 ON words_list (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE word DROP FOREIGN KEY FK_C3F1751199D5790');
        $this->addSql('DROP INDEX IDX_C3F1751199D5790 ON word');
        $this->addSql('ALTER TABLE word CHANGE words_list_id words_list_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE word ADD CONSTRAINT FK_C3F17511E01659A3 FOREIGN KEY (words_list_id_id) REFERENCES words_list (id)');
        $this->addSql('CREATE INDEX IDX_C3F17511E01659A3 ON word (words_list_id_id)');
        $this->addSql('ALTER TABLE words_list DROP FOREIGN KEY FK_B7304688A76ED395');
        $this->addSql('DROP INDEX IDX_B7304688A76ED395 ON words_list');
        $this->addSql('ALTER TABLE words_list CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE words_list ADD CONSTRAINT FK_B73046889D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_B73046889D86650F ON words_list (user_id_id)');
    }
}
