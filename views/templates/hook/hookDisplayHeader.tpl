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

<script type="text/javascript">

		{literal}
			!function(){var t=window.divvit=window.divvit||[];if(t.DV_VERSION="prestashop-1.1.8",t.init=function(e){if(!t.bInitialized){var i=document.createElement("script");i.setAttribute("type","text/javascript"),i.setAttribute("async",!0),i.setAttribute("src",{/literal}"{$DIVVIT_TAG_URL}{literal}/tag.js?id="+e);var n=document.getElementsByTagName("script")[0];n.parentNode.insertBefore(i,n)}},!t.bInitialized){t.functions=["customer","pageview","cartAdd","cartRemove","cartUpdated","orderPlaced","nlSubscribed","dv"];for(var e=0;e<t.functions.length;e++){var i=t.functions[e];t[i]=function(e){return function(){return Array.prototype.unshift.call(arguments,e),t.push(arguments),t}}(i)}}}();
		{/literal}
		divvit.init('{$DIVVIT_MERCHANT_ID|escape:'htmlall':'UTF-8'}');
		divvit.pageview();
</script>
