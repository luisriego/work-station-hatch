<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220518191520 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create tables and its relationships';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                CREATE TABLE `workstation_db_test`.`workstation` (
                    `id` CHAR(36) PRIMARY KEY NOT NULL,
                    `name` VARCHAR(50) DEFAULT NULL,
                    `floor` VARCHAR(4) DEFAULT NULL,
                    `oficce` VARCHAR(50) DEFAULT NULL,
                    INDEX IDX_workstation_name (`name`),
                    INDEX IDX_workstation_oficce (`oficce`)
                );
                CREATE TABLE `user_db_test`.`employee` (
                    `id` CHAR(36) PRIMARY KEY NOT NULL,
                    `name` VARCHAR(50) DEFAULT NULL,
                    `email` VARCHAR(100) DEFAULT NULL,
                    `password` VARCHAR(250) DEFAULT NULL,
                    INDEX IDX_employee_name (`name`)
                );
            SQL
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(
            <<<SQL
                DROP TABLE `rental_db`.`rental`;
                DROP TABLE `rental_db`.`car`;
                DROP TABLE `customer_db`.`customer`;
                DROP TABLE `employee_db`.`employee`;
            SQL
        );
    }
}