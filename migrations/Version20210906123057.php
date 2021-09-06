<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210906123057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE collectible (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, properties JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection_entity (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_FC0DBC9EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE collection_entity_collectible (collection_entity_id INT NOT NULL, collectible_id INT NOT NULL, INDEX IDX_16E123E8A70DCD3F (collection_entity_id), INDEX IDX_16E123E89700322F (collectible_id), PRIMARY KEY(collection_entity_id, collectible_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, receiver_username VARCHAR(255) DEFAULT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', author_username VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE collection_entity ADD CONSTRAINT FK_FC0DBC9EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE collection_entity_collectible ADD CONSTRAINT FK_16E123E8A70DCD3F FOREIGN KEY (collection_entity_id) REFERENCES collection_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE collection_entity_collectible ADD CONSTRAINT FK_16E123E89700322F FOREIGN KEY (collectible_id) REFERENCES collectible (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collection_entity_collectible DROP FOREIGN KEY FK_16E123E89700322F');
        $this->addSql('ALTER TABLE collection_entity_collectible DROP FOREIGN KEY FK_16E123E8A70DCD3F');
        $this->addSql('ALTER TABLE collection_entity DROP FOREIGN KEY FK_FC0DBC9EA76ED395');
        $this->addSql('DROP TABLE collectible');
        $this->addSql('DROP TABLE collection_entity');
        $this->addSql('DROP TABLE collection_entity_collectible');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE user');
    }
}
