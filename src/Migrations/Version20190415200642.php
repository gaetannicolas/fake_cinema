<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190415200642 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE screening (id INT AUTO_INCREMENT NOT NULL, film_id_id INT NOT NULL, room_id_id INT NOT NULL, started_at DATETIME NOT NULL, INDEX IDX_B708297DE6286007 (film_id_id), INDEX IDX_B708297D35F83FFC (room_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE screening ADD CONSTRAINT FK_B708297DE6286007 FOREIGN KEY (film_id_id) REFERENCES films (id)');
        $this->addSql('ALTER TABLE screening ADD CONSTRAINT FK_B708297D35F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE screening');
    }
}
