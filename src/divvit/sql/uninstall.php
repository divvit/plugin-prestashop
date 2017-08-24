<?php
/**
 * @author DivvitAB
 * @copyright DivvitAB
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class DivvitUninstallModule
{
    public static function uninstall()
    {
        $sql = array();
        $sql[] = 'DROP TABLE IF EXISTS `'._DB_PREFIX_.'divvit_customer_cookie`;';
        foreach ($sql as $query) {
            if (Db::getInstance()->execute($query) == false) {
                return false;
            }
        }
    }
}
