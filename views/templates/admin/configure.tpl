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

{if $is_saved}
	<div class="alert alert-success">
		{l s='Settings updated' mod='divvit'}
	</div>
{/if}
{if $error_message!=''}
	<div class="alert alert-danger">
		{$error_message|escape:'htmlall':'UTF-8'}
	</div>
{/if}

<div class="panel">
	<h3><i class="icon icon-credit-card"></i> {l s='Divvit' mod='divvit'}</h3>
	<p>Divvit is an intelligent ecommerce analytics platform that empowers online retailers, by providing real-time data that helps save money, ensure efficient spending and increase revenue.</p>
	<p>Get started by registering account at <a href="https://app.divvit.com/signup">https://app.divvit.com/signup</a></p>
</div>
