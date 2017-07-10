<?php

class DivvitQueryHelper extends ObjectModel {

    const LIMIT_ORDER = 100;
    const DIVVIT_TRACKER_URL = "https://tracker.staging.divvit.com/";

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
    public static function getCustomerCookie($customerId) {
        $sql = "SELECT * FROM "._DB_PREFIX_."divvit_customer_cookie WHERE customer_id = " . $customerId;
        $data = Db::getInstance()->getRow($sql);
        if (!$data) {
            return "";
        } else {
            return $data['cookie_data'];
        }
    }
    public static function getOrders($afterId) {
        $sql = "SELECT id_order FROM "._DB_PREFIX_."orders WHERE id_order > {$afterId} ORDER BY id_order DESC LIMIT " . self::LIMIT_ORDER;
        $orderArr = Db::getInstance()->executeS($sql);
        $orderIds = array();
        foreach ($orderArr as $oa) {
            $orderIds[] = $oa['id_order'];
        }
        $dataReturn = array();
        foreach ($orderIds as $orderId) {
            $order = new Order($orderId);
            $customer = $order->getCustomer();
            $currency = new Currency($order->id_currency);
            $orderData = array(
                'uid' => self::getCustomerCookie($customer->id),
                'createdAt' => $order->date_add,
                'orderId' => $order->id,
                'total' => $order->total_paid,
                'totalProductsNet' => $order->total_products,
                'shipping' => $order->total_shipping,
                'currency' => $currency->iso_code,
                'customer' => array(
                    'name' => $customer->firstname . " " . $customer->lastname,
                    'id' => $customer->id,
                    'idFields' => array(
                        'email' => $customer->email
                    )
                )
            );
            $productsArr = array();
            foreach ($order->getProducts() as $product) {
                $productsArr[] = array(
                    'id' => $product['id_product'],
                    'name' => $product['product_name'],
                    'price' => $product['unit_price_tax_incl'],
                    'currency' => $currency->iso_code,
                    'quantity' => $product['product_quantity']
                );
            }
            $orderData['products'] = $productsArr;
            $dataReturn[] = $orderData;
        }
        return $dataReturn;
    }

    public static function getDivvitAuthToken() {
        $url = self::DIVVIT_TRACKER_URL . "auth/register";
        $params = array(
            'frontendId' => Configuration::get("DIVVIT_MERCHANT_ID"),
            'url' =>   Tools::getHttpHost(true) . __PS_BASE_URI__ . "divvitOrders"
        );
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen(json_encode($params)))
        );

        $resultStr = curl_exec($ch);
        $result = json_decode($resultStr, true);
        if ($result AND isset($result['accessToken'])) {
            Configuration::updateValue('DIVVIT_ACCESS_TOKEN', $result['accessToken']);
        } else {
            $oldToken = Configuration::get('DIVVIT_ACCESS_TOKEN');
            if (!$oldToken) {
                Configuration::updateValue('DIVVIT_ACCESS_TOKEN', "invalid");
            }
        }
    }
}