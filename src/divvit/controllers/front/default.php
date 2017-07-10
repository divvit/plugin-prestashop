<?php
/**
 * Created by PhpStorm.
 * User: vokimnguyen
 * Date: 6/20/17
 * Time: 10:37 PM
 */

class DivvitDefaultModuleFrontController extends ModuleFrontControllerCore {
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
            $headers = array ();
            foreach ($_SERVER as $name => $value)
            {
                if (substr($name, 0, 5) == 'HTTP_')
                {
                    $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                }
            }
            return $headers;
        }
    }
    private function validateToken() {
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