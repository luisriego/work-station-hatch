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
                CREATE TABLE `user_db`.`user` (
                    `id` CHAR(36) PRIMARY KEY NOT NULL,
                    `name` VARCHAR(50) DEFAULT NULL,
                    `email` VARCHAR(100) DEFAULT NULL,
                    `password` VARCHAR(250) DEFAULT NULL,
                    INDEX IDX_user_name (`name`)
                );
                CREATE TABLE `reservation_db`.`reservation` (
                    `id` CHAR(36) PRIMARY KEY NOT NULL,
                    `user_id` CHAR(36) NOT NULL,
                    `workstation_id` CHAR(36) NOT NULL,
                    `start_date` DATETIME DEFAULT NULL,
                    `end_date` DATETIME DEFAULT NULL,
                    `is_active` TINYINT(1) NOT NULL,
                    `created_on` DATETIME DEFAULT NULL,
                    INDEX IDX_reservation_workstation_id (`workstation_id`),
                    INDEX IDX_reservation_user_id (`user_id`)
                );
                CREATE TABLE `reservation_db`.`workstation` (
                    `id` CHAR(36) PRIMARY KEY NOT NULL,
                    `name` VARCHAR(50) DEFAULT NULL,
                    `floor` VARCHAR(4) DEFAULT NULL,
                    `office` VARCHAR(50) DEFAULT NULL,
                    `is_active` TINYINT(1) NOT NULL,
                    INDEX IDX_workstation_name (`name`),
                    INDEX IDX_workstation_oficce (`office`)
                );
            SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                DROP TABLE `reservation_db`.`workstation`;
                DROP TABLE `reservation_db`.`reservation`;
                DROP TABLE `user_db`.`user`;
            SQL
        );
    }
}