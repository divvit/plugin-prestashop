<?php
/**
 * @author DivvitAB
 * @copyright DivvitAB
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class DivvitQueryHelper extends ObjectModel
{
    const LIMIT_ORDER = 100;

    public static function saveCustomerCookie($customerId)
    {
        $cookieDivvit = self::getDivvitCookie();
        if ($cookieDivvit) {
            $sql = "SELECT id FROM "._DB_PREFIX_."divvit_customer_cookie WHERE customer_id = ".(int)$customerId;
            $data = Db::getInstance()->getRow($sql);
            if (!$data) {
                $sql = "INSERT INTO "._DB_PREFIX_."divvit_customer_cookie SET "
                    ."customer_id = ".(int)$customerId.", "
                    ."cookie_data = '".pSQL($cookieDivvit)."', updated_at = NOW(), created_at = NOW()";
                Db::getInstance()->execute($sql);
            } else {
                $sql = "UPDATE "._DB_PREFIX_."divvit_customer_cookie SET "
                    ."updated_at = NOW(), cookie_data = '".pSQL($cookieDivvit)."' "
                    ."WHERE customer_id = ".(int)$customerId;
                Db::getInstance()->execute($sql);
            }
        }
    }

    public static function getCustomerCookie($customerId)
    {
        $sql = "SELECT * FROM "._DB_PREFIX_."divvit_customer_cookie WHERE customer_id = ".(int)$customerId;
        $data = Db::getInstance()->getRow($sql);
        if (!$data) {
            return "";
        } else {
            return $data['cookie_data'];
        }
    }

    public static function getOrders($afterId)
    {
        $sql = "SELECT id_order FROM "._DB_PREFIX_."orders "
            ."WHERE id_order > ".(int)$afterId." ORDER BY id_order DESC LIMIT ".self::LIMIT_ORDER;
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
                    'name' => $customer->firstname." ".$customer->lastname,
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

    public static function getDivvitAuthToken()
    {
        $url = Divvit::$TRACKER_URL.'/auth/register';
        $moduleUrl = Context::getContext()->link->getModuleLink('divvit', 'default');
        $params = array(
            'frontendId' => Configuration::get("DIVVIT_MERCHANT_ID"),
            'url' => $moduleUrl
        );
        $ch = curl_init($url);
        Logger::addLog('Divvit: registering shop on Divvit '.$moduleUrl, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: '.Tools::strlen(json_encode($params))
        ));

        // Disable SSL check for DEV environment
        if (getenv('DIVVIT_DEV')) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $resultStr = curl_exec($ch);
        if (!$resultStr) {
            Logger::addLog('Divvit: error registering ('.curl_error($ch).')', 2);
            throw new Exception('Error registering plugin on Divvit. Check log for more information.');
        }

        $result = json_decode($resultStr, true);
        if ($result and isset($result['accessToken'])) {
            Configuration::updateValue('DIVVIT_ACCESS_TOKEN', $result['accessToken']);
        } else {
            $oldToken = Configuration::get('DIVVIT_ACCESS_TOKEN');
            if (!$oldToken) {
                Configuration::updateValue('DIVVIT_ACCESS_TOKEN', NULL);
            }
        }
        curl_close($ch);
    }

    public static function getDivvitCookie()
    {
        $realCookie = ${'_COOKIE'};
        if (isset($realCookie['DV_TRACK'])) {
            return $realCookie['DV_TRACK'];
        } else {
            return false;
        }
    }
}
