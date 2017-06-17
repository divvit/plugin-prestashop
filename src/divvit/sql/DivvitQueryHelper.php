<?php

class DivvitQueryHelper extends ObjectModel {
    public static function saveCustomerCookie($customerId) {
        if (isset($_COOKIE['DV_TRACK'])) {
            $sql = "SELECT id FROM "._DB_PREFIX_."divvit_customer_cookie WHERE customer_id = " . $customerId;
            $data = Db::getInstance()->getRow($sql);
            if (!$data) {
                $sql = "INSERT INTO "._DB_PREFIX_."divvit_customer_cookie SET customer_id = {$customerId}, cookie_data = '".$_COOKIE['DV_TRACK']."', updated_at = NOW(), created_at = NOW()";
                Db::getInstance()->execute($sql);
            } else {
                $sql = "UPDATE " . _DB_PREFIX_ . "divvit_customer_cookie SET updated_at = NOW(), cookie_data = '".$_COOKIE['DV_TRACK']."' WHERE customer_id = " . $customerId;
                Db::getInstance()->execute($sql);
            }
        }
    }
}