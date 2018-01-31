<?php
include_once('../../config/config.inc.php');
include_once('../../init.php');
include_once('divvit.php');

$divvit = new Divvit();

if (!Tools::isSubmit('secure_key') || Tools::getValue('secure_key') != $divvit->secure_key || !Tools::getValue('action'))
		die(1);

if (Tools::getValue('action') == 'updateFrontendId' && Tools::getValue('frontendId'))
{
	  Configuration::updateValue('DIVVIT_MERCHANT_ID', Tools::getValue('frontendId'));
	  DivvitQueryHelper::getDivvitAuthToken();
}

if (Tools::getValue('action') == 'resetFrontendId')
{
		Configuration::deleteByName('DIVVIT_MERCHANT_ID');
		Configuration::deleteByName('DIVVIT_ACCESS_TOKEN');
}
