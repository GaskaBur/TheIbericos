{*
* 2007-2012 PrestaShop
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
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2012 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
*  Modificado por Noises of Hill para facturas Española.
*}
<!-- FINAL TABLE -->

<table style="width:100%">
<tr style="border-collapse: separate; border-spacing: 1pt;">

<!-- IVA -->
<td style="width:60%">

<table style="width: 100%">
	<tr>
		<td>
			{if $tax_exempt}
				{l s='Exempt of VAT according section 259B of the General Tax Code.' pdf='true'}
			{else}
			<table style="width: 100%; border-collapse: separate; border-spacing: 1.4pt;" >
            <tr style="line-height:1.8pt">
              <td colspan="5" style="padding-top: 7pt; padding-bottom: 7pt; text-align: center; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 10px; font-weight: thin; font-size: 11pt; padding-top: 7pt; padding-bottom: 7pt">{l s='Tax summary' mod='factSpa'}</td></tr>
            
				<tr style="line-height:5px; text-align:right">
					<td style="padding-top: 7pt; padding-bottom: 7pt; text-align: center; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 2pt; font-size: 8pt; padding-top: 7pt; padding-bottom: 7pt; width: 25%">{l s='details' mod='factSpa'}</td>
					
					{if !$use_one_after_another_method}
						<td style=" padding-top: 7pt; padding-bottom: 7pt; text-align: right; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 2pt; font-size: 8pt; padding-top: 7pt; padding-bottom: 7pt; width: 21%">{l s='base' mod='factSpa'}</td>
					{/if}
                    <td style="padding-top: 7pt; padding-bottom: 7pt; text-align: center; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 2pt; font-size: 8pt; padding-top: 7pt; padding-bottom: 7pt; width: 17%">{l s='Tax rate' mod='factSpa'}</td>
					<td style="padding-top: 7pt; padding-bottom: 7pt; text-align: center; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 2pt; font-size: 8pt; padding-top: 7pt; padding-bottom: 7pt; width: 17%">{l s='Total Tax' mod='factSpa'}</td>
                    <td style="padding-top: 7pt; padding-bottom: 7pt; text-align: center; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 2pt; font-size: 8pt; padding-top: 7pt; padding-bottom: 7pt; width: 20%">Total</td>
				</tr>

				{if isset($product_tax_breakdown)}
				{foreach $product_tax_breakdown as $rate => $product_tax_infos}
				<tr style="line-height:6px;background-color:{cycle values='#FFF,#DDD'}; text-align:left; line-height: 1.5pt; color:#404040; font-size:9pt">
				 <td style="width: 25%">{l s='Products' pdf='true'}</td>
				 
				{if !$use_one_after_another_method}
				 <td style="width: 21%; text-align: right;">
					 {if isset($is_order_slip) && $is_order_slip}- {/if}{displayPrice currency=$order->id_currency price=($product_tax_infos.total_price_tax_excl + $order_invoice->total_discount_tax_excl)}
				 </td>
				{/if}
                <td style="width: 17%; text-align: right;">{round($rate)} %</td>
				 <td style="width: 17%; text-align: center;">{if isset($is_order_slip) && $is_order_slip}- {/if}{displayPrice currency=$order->id_currency price=$product_tax_infos.total_amount}</td>
                 <td style="width: 20%; text-align: center;">{displayPrice currency=$order->id_currency price=$order_invoice->total_products_wt}</td>
				</tr>
				{/foreach}
				{/if}

				{if isset($shipping_tax_breakdown)}
				{foreach $shipping_tax_breakdown as $shipping_tax_infos}
                {if $order_invoice->total_shipping_tax_incl > 0}
				<tr style="line-height:6px;background-color:{cycle values='#FFF,#DDD'}; text-align:left; line-height: 1.5pt; color:#404040; font-size:9pt">
				 <td style="width: 25%">{l s='Shipping' pdf='true'}</td>
				 
 				{if !$use_one_after_another_method}
					 <td style="width: 21%; text-align: right;">{if isset($is_order_slip) && $is_order_slip}- {/if}{displayPrice currency=$order->id_currency price=$shipping_tax_infos.total_tax_excl}</td>
				{/if}
                <td style="width: 17%; text-align: right;">
                 {round($shipping_tax_infos.rate)} %</td>
				 <td style="width: 17%; text-align: center;">{if isset($is_order_slip) && $is_order_slip}- {/if}{displayPrice currency=$order->id_currency price=$shipping_tax_infos.total_amount}</td>
                 <td style="width: 20%; text-align: center;">{if $tax_excluded_display}
							{displayPrice currency=$order->id_currency price=$order_invoice->total_shipping_tax_excl}
							{else}
							{displayPrice currency=$order->id_currency price=$order_invoice->total_shipping_tax_incl}
						{/if}</td>
				</tr>{/if}{/foreach}{/if}
				
					{if $order_invoice->total_discount_tax_incl > 0}
					<tr style="line-height:6px;background-color:{cycle values='#FFF,#DDD'}; text-align:left; line-height: 1.5pt; color:#404040; font-size:9pt">
						<td style="width: 25%">Descuentos</td>
                        {assign var="dtoSinIva" value=$order_invoice->total_discount_tax_excl}
                        {assign var="dtoConIva" value=$order_invoice->total_discount_tax_incl}
                        {assign var="ivaDto" value=$dtoConIva - $dtoSinIva}
						<td style="width: 21%; text-align: right;">{displayPrice currency=$order->id_currency price=$order_invoice->total_discount_tax_excl}</td>
						{if !$use_one_after_another_method}
							<td style="width: 17%; text-align: right;">{round($ivaDto * 100 / $dtoSinIva)} %</td>
						{/if}
                        
						<td style="width: 17%; text-align: center;">{displayPrice currency=$order->id_currency price=$order_invoice->total_discount_tax_incl - $dtoSinIva } </td>
                        <td style="width: 20%; text-align: center;">-{displayPrice currency=$order->id_currency price=$order_invoice->total_discount_tax_incl}</td>
					</tr>
					{/if}
				
			</table>
			{/if}
		</td>
	</tr>
</table>

</td>
<!--/ IVA -->

<!-- MARGEN -->
<td style="width:3%">&nbsp;</td>
<!--/ MARGEN -->

<!--/ TOTALES -->
<td style="width:37%">

<table style="width:100%; border-collapse: separate; border-spacing: 1.4pt;">
<tr style="line-height: 1.8pt;">
<td colspan="2" style="padding-top: 7pt; padding-bottom: 7pt; text-align: center; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 10px; font-weight: thin; font-size: 11pt; padding-top: 7pt; padding-bottom: 7pt;">{l s='Total Invoice' mod='factSpa'}</td></tr>
<tr style="line-height: 1.5pt;">
<td style="width:60%; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; font-size:9pt; text-align:right;">{l s='Detail' mod='factSpa'}</td>
<td style="width:40%; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; font-size:9pt; text-align:right;">{l s='Import' mod='factSpa'}</td>

</tr>

<!-- <tr style="line-height: 1.5pt; color:#000; text-align:right">
<td style="width:60%; background-color: #ded4d4; font-size:9pt; color:#000">{l s='Product Total (Tax Excl.)' pdf='true'}</td>
<td style="width:40%; background-color: #ded4d4; font-size:10pt; color:#000">{displayPrice currency=$order->id_currency price=$order_invoice->total_products}</td></tr> -->

<tr style="line-height: 1.5pt; color:#404040; text-align:right; font-size:10pt">
<td style="width:60%; background-color: #F2F2F2;font-size:9pt;">{l s='Total Base' mod='factSpa'}</td>
<td style="width:40%; background-color: #F2F2F2; font-size:9pt">{displayPrice currency=$order->id_currency price=($order_invoice->total_products+$shipping_tax_infos.total_tax_excl)}</td></tr>

{if ($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl) > 0}
<tr style="line-height: 1.5pt; color:#404040; text-align:right; font-size:10pt">
<td style="width:60%; background-color: #F2F2F2;font-size:9pt;">{l s='Total Tax' mod='factSpa'}</td>
<td style="width:40%; background-color: #F2F2F2; font-size:9pt">{displayPrice currency=$order->id_currency price=($order_invoice->total_paid_tax_incl - $order_invoice->total_paid_tax_excl)}</td></tr>
{/if}

<!--{if $order_invoice->total_shipping_tax_incl > 0}
<tr style="line-height: 1.5pt; color:#000; text-align:right; font-size:10pt">
<td style="width:60%; background-color: #ded4d4;font-size:9pt;">Base Imp. Transporte</td>
<td style="width:40%; background-color: #ded4d4; font-size:9pt">{if isset($is_order_slip) && $is_order_slip}- {/if}{displayPrice currency=$order->id_currency price=$shipping_tax_infos.total_tax_excl}</td></tr>{/if} -->

{if $order_invoice->total_discount_tax_incl > 0}
<tr style="line-height: 1.5pt; color:#404040; text-align:right; font-size:10pt">
<td style="width:60%; background-color: #F2F2F2;font-size:9pt;">{l s='Total Discount tax excl' mod='factSpa'}</td>
<td style="width:40%; background-color: #F2F2F2; font-size:9pt">-{displayPrice currency=$order->id_currency price=($order_invoice->total_discount_tax_excl + $shipping_discount_tax_excl)}</td></tr>{/if}




<tr style="line-height: 1.5pt; color:{Configuration::get('FSPA_textColor')}; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; font-size: 11pt; font-weight: bold; text-align:right">
<td style="width:60%; text-align:right">{l s='Total' pdf='true'}</td>
<td style="width:40%">{displayPrice currency=$order->id_currency price=$order_invoice->total_paid_tax_incl}</td></tr></table>


</td>
<!--/ TOTALES -->

</tr>
</table>

<!-- / FINAL TABLE -->

