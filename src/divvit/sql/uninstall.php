<?php

class DivvitUninstallModule {
    public static function uninstall() {
        $sql = array();
        $sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'divvit_customer_cookie`;';
        foreach ($sql as $query) {
            if (Db::getInstance()->execute($query) == false) {
                return false;
            }
        }
    }
}


