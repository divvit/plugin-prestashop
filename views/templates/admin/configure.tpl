{*
* 2007-2015 PrestaShop
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

<link href="{$module_dir|escape:'htmlall':'UTF-8'}views/css/back.css" rel="stylesheet" type="text/css" media="all" />
<script>
	var DIVVIT_PLUGIN_SECURE_KEY = "{$secure_key}";
	var DIVVIT_APP_URL = "{$app_url}";
</script>
<script type="text/javascript" src="{$module_dir|escape:'htmlall':'UTF-8'}views/js/back.js"></script>

<div class="panel">
	<h3><i class="icon icon-credit-card"></i> {l s='Divvit' mod='divvit'}</h3>
	{if $divvit_access_token}
		<iframe src="{$app_url}/prestashop?embedded=prestashop&email={$email}&frontendId={$divvit_frontendId}&__trackerToken={$divvit_access_token}" width="100%" height="600" border="0" id="divvit_iframe"></iframe>
	{else}
		<iframe src="{$app_url}/prestashop?embedded=prestashop&platform=prestashop&email={$email}&firstName={$firstname}&lastName={$lastname}&url={$url}&currency={$currency}&timezone={$timezone|escape:'url'}&industry=other" width="100%" height="600" border="0" id="divvit_iframe"></iframe>
	{/if}
</div>
