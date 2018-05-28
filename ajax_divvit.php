<?php
/**
 * 2015-2017 Divvit AB.
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
 *  @author    PrestaShop SA <contact@prestashop.com>
 *  @copyright 2007-2016 PrestaShop SA
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
 
include_once '../../config/config.inc.php';
include_once '../../init.php';
include_once 'divvit.php';

$divvit = new Divvit();

if (!Tools::isSubmit('secure_key') ||
  Tools::getValue('secure_key') != $divvit->secure_key ||
  !Tools::getValue('action')
) {
    die(1);
}

if (Tools::getValue('action') == 'updateFrontendId' && Tools::getValue('frontendId')) {
    Configuration::updateValue('DIVVIT_MERCHANT_ID', Tools::getValue('frontendId'));
    DivvitQueryHelper::getDivvitAuthToken();
}

if (Tools::getValue('action') == 'resetFrontendId') {
    Configuration::updateValue('DIVVIT_MERCHANT_ID', null);
    Configuration::updateValue('DIVVIT_ACCESS_TOKEN', null);
}
