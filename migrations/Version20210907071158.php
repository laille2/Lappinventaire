<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210907071158 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alarm (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, properties JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alarm_collection_entity (alarm_id INT NOT NULL, collection_entity_id INT NOT NULL, INDEX IDX_BB24D60F25830571 (alarm_id), INDEX IDX_BB24D60FA70DCD3F (collection_entity_id), PRIMARY KEY(alarm_id, collection_entity_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alarm_collectible (alarm_id INT NOT NULL, collectible_id INT NOT NULL, INDEX IDX_22A3838325830571 (alarm_id), INDEX IDX_22A383839700322F (collectible_id), PRIMARY KEY(alarm_id, collectible_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alarm_collection_entity ADD CONSTRAINT FK_BB24D60F25830571 FOREIGN KEY (alarm_id) REFERENCES alarm (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alarm_collection_entity ADD CONSTRAINT FK_BB24D60FA70DCD3F FOREIGN KEY (collection_entity_id) REFERENCES collection_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alarm_collectible ADD CONSTRAINT FK_22A3838325830571 FOREIGN KEY (alarm_id) REFERENCES alarm (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alarm_collectible ADD CONSTRAINT FK_22A383839700322F FOREIGN KEY (collectible_id) REFERENCES collectible (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alarm_collection_entity DROP FOREIGN KEY FK_BB24D60F25830571');
        $this->addSql('ALTER TABLE alarm_collectible DROP FOREIGN KEY FK_22A3838325830571');
        $this->addSql('DROP TABLE alarm');
        $this->addSql('DROP TABLE alarm_collection_entity');
        $this->addSql('DROP TABLE alarm_collectible');
    }
}
