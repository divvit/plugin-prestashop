{*
* 2015-2017 Divvit AB
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    Divvit AB
*  @copyright 2015-2017 Divvit AB
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<script>
    divvit.orderPlaced({
        order: {
            products: [
                {foreach name=aussen item=product from=$ORDER_PRODUCTS}
                {
                    id: "{$product['id']|escape:'htmlall':'UTF-8'}",
                    name: "{$product['name']|escape:'htmlall':'UTF-8'}",
                    category: "[{$product['category']|escape:'htmlall':'UTF-8'}]",
                    quantity: "{$product['quantity']|escape:'htmlall':'UTF-8'}",
                    price: "{$product['price']|escape:'htmlall':'UTF-8'}",
                    currency: "{$product['currency']|escape:'htmlall':'UTF-8'}",
                },
                {/foreach}
            ],
            orderId: "{$ORDER_DETAILS['id']|escape:'htmlall':'UTF-8'}",
            total: "{$ORDER_DETAILS['total']|escape:'htmlall':'UTF-8'}",
            currency: "{$ORDER_DETAILS['currency']|escape:'htmlall':'UTF-8'}",
            totalProductsNet: "{$ORDER_DETAILS['totalProductsNet']|escape:'htmlall':'UTF-8'}",
            shipping: "{$ORDER_DETAILS['shipping']|escape:'htmlall':'UTF-8'}",
            customer:{
                idFields: {
                    email: "{$ORDER_DETAILS['userMail']|escape:'htmlall':'UTF-8'}"
                },
                name: "{$ORDER_DETAILS['userName']|escape:'htmlall':'UTF-8'}"
            }
        }
    });
</script>