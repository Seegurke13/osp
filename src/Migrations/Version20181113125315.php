<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181113125315 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE protocol_content (id INT AUTO_INCREMENT NOT NULL, protocol_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, result LONGTEXT DEFAULT NULL, INDEX IDX_DBE79E0CCCD59258 (protocol_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE protocol_content ADD CONSTRAINT FK_DBE79E0CCCD59258 FOREIGN KEY (protocol_id) REFERENCES protocol (id)');
        $this->addSql('ALTER TABLE protocol ADD tags_id INT DEFAULT NULL, ADD creator INT NOT NULL');
        $this->addSql('ALTER TABLE protocol ADD CONSTRAINT FK_C8C0BC4C8D7B4FB4 FOREIGN KEY (tags_id) REFERENCES tag (id)');
        $this->addSql('CREATE INDEX IDX_C8C0BC4C8D7B4FB4 ON protocol (tags_id)');
        $this->addSql('ALTER TABLE protocol_version CHANGE protocol_id protocol_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE protocol_content');
        $this->addSql('ALTER TABLE protocol DROP FOREIGN KEY FK_C8C0BC4C8D7B4FB4');
        $this->addSql('DROP INDEX IDX_C8C0BC4C8D7B4FB4 ON protocol');
        $this->addSql('ALTER TABLE protocol DROP tags_id, DROP creator');
        $this->addSql('ALTER TABLE protocol_version CHANGE protocol_id protocol_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_bin');
    }
}
