<?php

class DivvitInstallModule {
    public static function install() {
        $sql = array();

        $sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'divvit_customer_cookie` (
                      `id` INT NOT NULL AUTO_INCREMENT COMMENT \'\',
                      `customer_id` INT NULL COMMENT \'\',
                      `cookie_data` VARCHAR(255) NULL COMMENT \'\',
                      `created_at` DATETIME NULL COMMENT \'\',
                      `updated_at` DATETIME NULL COMMENT \'\',
                      PRIMARY KEY (`id`)  COMMENT \'\',
                      INDEX `customer_id_idx` (`customer_id` ASC)  COMMENT \'\')
                      ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

        foreach ($sql as $query) {
            if (Db::getInstance()->execute($query) == false) {
                return false;
            }
        }
    }
}
