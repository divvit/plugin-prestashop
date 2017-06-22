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
        $afterOrderId = Tools::getValue("after", 0);
        $orders = DivvitQueryHelper::getOrders($afterOrderId);
        echo json_encode($orders);
        exit();
    }
}