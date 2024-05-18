<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240513080112 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task_task ADD inn VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE task_task ADD auc VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE task_task ADD has_prepaid BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE task_task ADD multi_lot BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE task_task ADD sum_bg NUMERIC(10, 0) DEFAULT NULL');
        $this->addSql('ALTER TABLE task_task ADD sum_deal NUMERIC(10, 0) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE task_task DROP inn');
        $this->addSql('ALTER TABLE task_task DROP auc');
        $this->addSql('ALTER TABLE task_task DROP has_prepaid');
        $this->addSql('ALTER TABLE task_task DROP multi_lot');
        $this->addSql('ALTER TABLE task_task DROP sum_bg');
        $this->addSql('ALTER TABLE task_task DROP sum_deal');
    }
}
