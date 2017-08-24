<?php
/**
 * @author DivvitAB
 * @copyright DivvitAB
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class DivvitDefaultModuleFrontController extends ModuleFrontControllerCore
{
    public function initContent()
    {
        $accessToken = $this->validateToken();
        if ($accessToken) {
            $afterOrderId = Tools::getValue("after", 0);
            $orders = DivvitQueryHelper::getOrders($afterOrderId);
            echo json_encode($orders);
            exit();
        } else {
            http_response_code(401);
            header("Status: UNAUTHORIZED");
            exit();
        }
    }

    /**
     * If server config use Apache, we can use default function getallheaders(), if nginx, get manual
     * @return array
     */
    private function getallheaders()
    {
        if (function_exists('getallheaders')) {
            return getallheaders();
        } else {
            $headers = array();
            foreach ($_SERVER as $name => $value) {
                if (Tools::substr($name, 0, 5) == 'HTTP_') {
                    $key = str_replace(' ', '-', ucwords(Tools::strtolower(str_replace('_', ' ', Tools::substr($name, 5)))));
                    $headers[$key] = $value;
                }
            }
            return $headers;
        }
    }

    private function validateToken()
    {
        $accessToken = Configuration::get('DIVVIT_ACCESS_TOKEN');
        if (!$accessToken) {
            DivvitQueryHelper::getDivvitAuthToken();
            $accessToken = Configuration::get('DIVVIT_ACCESS_TOKEN');
        }
        $headers = $this->getallheaders();
        if (isset($headers['Authorization'])) {
            if ($headers['Authorization'] == sprintf("token %s", $accessToken)) {
                return $accessToken;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
