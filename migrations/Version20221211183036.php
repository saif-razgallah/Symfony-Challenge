<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221211183036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25A8E564D3');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25A8E564D3 FOREIGN KEY (user_affect_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25A8E564D3');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25A8E564D3 FOREIGN KEY (user_affect_id) REFERENCES user (id)');
    }
}
