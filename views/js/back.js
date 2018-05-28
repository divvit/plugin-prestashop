/**
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2015-2017 Divvit AB
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/

window.addEventListener('message', function(event) {
  if (event.origin !== window.DIVVIT_APP_URL) return;
  var data = event.data.split(':')
  var key = data[0]
  var value = data[1]
  console.log(event.data);

  switch (key) {
    case 'height':
      var divvitIframe = document.getElementById('divvit_iframe')
      divvitIframe.setAttribute('height', value)
      break

    case 'frontendId':
      $.post(window.SHOPURL+'modules/divvit/ajax_divvit.php', {
        secure_key: window.DIVVIT_PLUGIN_SECURE_KEY,
        action: 'updateFrontendId',
        frontendId: value,
      })
      break
    case 'resetFrontendId':
      $.post(window.SHOPURL+'modules/divvit/ajax_divvit.php', {
        secure_key: window.DIVVIT_PLUGIN_SECURE_KEY,
        action: 'resetFrontendId',
      })
      break

    default:
      return
  }
}, false)
