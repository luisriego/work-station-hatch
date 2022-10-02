<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220518191510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create tables and its relationships';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                CREATE TABLE `workstation_db`.`workstation` (
                    `id` CHAR(36) PRIMARY KEY NOT NULL,
                    `name` VARCHAR(50) DEFAULT NULL,
                    `floor` VARCHAR(4) DEFAULT NULL,
                    `office` VARCHAR(50) DEFAULT NULL,
                    INDEX IDX_workstation_name (`name`),
                    INDEX IDX_workstation_oficce (`office`)
                );
                CREATE TABLE `user_db`.`user` (
                    `id` CHAR(36) PRIMARY KEY NOT NULL,
                    `name` VARCHAR(50) DEFAULT NULL,
                    `email` VARCHAR(100) DEFAULT NULL,
                    `password` VARCHAR(250) DEFAULT NULL,
                    INDEX IDX_user_name (`name`),
                    UNIQUE U_user_email ('email')
                );
            SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                DROP TABLE `workstation_db`.`customer`;
                DROP TABLE `user_db`.`employee`;
            SQL
        );
    }
}