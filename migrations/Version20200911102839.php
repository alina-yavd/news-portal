<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20200911102839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add category slug.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE category ADD slug VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE category DROP slug');
    }
}
