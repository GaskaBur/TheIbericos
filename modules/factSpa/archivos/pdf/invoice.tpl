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
*  @version  Release: $Revision: 6753 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div style="font-size: 8pt; color: #444">

	<!-- HEADER -->

	<table style="width: 100%; height: 120px;">
		<tr><td colspan="5"><div style="line-height: 4pt">&nbsp;</div></td></tr>
		<tr>
			<td style="width:30%">
		        <table style="vertical-align: bottom">
		      		{if Configuration::get('FSPA_razonSocial')}<tr> <td style="font-size: 7pt; font-weight: normal; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align:left">{Configuration::get('FSPA_razonSocial')}</td></tr>{/if}
					{if Configuration::get('FSPA_nombre')}<tr> <td style="font-size: 7pt; font-weight: normal; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align:left">{Configuration::get('FSPA_nombre')}</td></tr>{/if}
					{if Configuration::get('FSPA_cif')}<tr> <td style="font-size: 7pt; font-weight: normal; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align:left">{Configuration::get('FSPA_cif')}</td></tr>{/if}
					{if Configuration::get('FSPA_domicilio')}<tr> <td style="font-size: 7pt; font-weight: normal; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align:left">{Configuration::get('FSPA_domicilio')}</td></tr>{/if}
					{if Configuration::get('FSPA_localidad') || Configuration::get('FSPA_Provincia')}<tr> <td style="font-size: 7pt; font-weight: normal; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align:left">{Configuration::get('FSPA_localidad')} - {Configuration::get('FSPA_Provincia')}</td></tr>{/if}
					{if Configuration::get('FSPA_Pais')}<tr> <td style="font-size: 7pt; font-weight: normal; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align:left">{Configuration::get('FSPA_Pais')}</td></tr>{/if}
					{if Configuration::get('FSPA_telefono') || Configuration::get('FSPA_fax')}<tr> <td style="font-size: 7pt; font-weight: normal; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align:left">Tfn: {Configuration::get('FSPA_telefono')} - Fax: {Configuration::get('FSPA_fax')}</td></tr>{/if}
					{if Configuration::get('FSPA_mail')}<tr> <td style="font-size: 7pt; font-weight: normal; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align:left">{Configuration::get('FSPA_mail')}</td></tr>{/if}
					{if Configuration::get('FSPA_otro')}<tr> <td style="font-size: 7pt; font-weight: normal; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align:left">{Configuration::get('FSPA_otro')}</td></tr>{/if}
				</table>
			</td>

			<td style="width:35%; position:relative">
				{if $logo_path}
			  		<img align="left" src="{$logo_path}" width="160" />
				{/if}              
	        </td>    
	    
			<td style="width: 35%;  text-align: right; vertical-align: middle; padding-left: 15pt">
				<table>
		        	
					<tr>
						<td style="font-weight: bold; font-size: 14pt; color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; width: 100%; text-align:right">{l s='Invoice' mod='factSpa'}</td>
					</tr>
					<tr>
						<td style="font-size: 11pt; font-weight: bold; color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; text-align: right;">{l s='Number' mod='factSpa'} {$title|escape:'htmlall':'UTF-8'}</td>
					</tr>
		            
		            <tr>
						<td style="font-size: 10pt; font-weight: normal; color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; text-align: right;">{l s='Date' mod='factSpa'}: {$date|escape:'htmlall':'UTF-8'}</td>
					</tr>
		            
				</table>
			</td>
		</tr>
	</table>


	<div style="line-height: 2pt">&nbsp;</div>

  	<!-- ADDRESSES -->

 	<table style="width: 100%">
 
  		<tr>
  			<td style="width:100%">
				{if !empty($delivery_address)}
					<table style="width: 100%;">
						<tr>
                    		<td style="width: 48%">
                                <table style="width: 100%">
									<tr style="width: 50%; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; font-weight: normal; line-height: 1.5pt; font-size: 11pt; color: {Configuration::get('FSPA_textColor')}">
						  				<td style="padding-top: 7pt; padding-bottom: 7pt; padding-left: 5pt">{l s='Shipping address' mod='factSpa'}</td>
						  			</tr>
                            		<tr style="width: 50%; background-color: #F2F2F2;">
                            			<td style="padding-top: 10pt; padding-bottom: 10pt; padding-left: 5pt; font-size: 10pt;">
                            				<div style="line-height: 0.8pt">&nbsp;</div>
                            				{$delivery_address}<br/>
										</td>
									</tr>
								</table>
							</td>
                        	<td style="width: 5%"></td>
                        	<td style="width: 47%">
                        		<table style="width: 100%">
									<tr style="width: 50%; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; line-height: 1.5pt; font-weight: normal; font-size: 11pt; color: #ffffff">
						  				<td style="padding-top: 7pt; padding-bottom: 7pt; padding-left: 5pt">{l s='Invoice address' mod='factSpa'}</td>
						  			</tr>
                            		<tr style="width: 50%;">
                              			<td style="padding-top: 10pt; padding-bottom: 10pt; padding-left: 5pt; font-size: 10pt;"><div style="line-height: 0.8pt">&nbsp;</div>{$invoice_address}<br />
                              			</td>
                              		</tr>
                              	</table>
                            </td>						
						</tr>
					</table>
				{else}
					<table style="width: 100%">
						<tr>	
                    		<td style="width: 48%">
								<table style="width: 100%">
									<tr style="width: 200px; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; line-height: 1.5pt; font-weight: normal; font-size: 11pt; color: {Configuration::get('FSPA_textColor')};padding-top: 7pt; padding-bottom: 7pt;">
						  				<td style="padding-top: 7pt; padding-bottom: 7pt; padding-left: 5pt">{l s='Shipping address' mod='factSpa'}</td>
						  			</tr> 
                            		<tr style="width: 50%; background-color: #F2F2F2;">
                              			<td style="padding-top: 10pt; padding-bottom: 10pt; padding-left: 5pt; font-size: 10pt; color:#404040"><div style="line-height: 0.8pt">&nbsp;</div>{$invoice_address}<br />
                              			</td>
                              		</tr>
                              	</table>
							</td>
                        	<td style="width: 5%"></td>
          					<td style="width: 47%">
          						<table style="width: 100%">
									<tr style="width: 200px; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; line-height: 1.5pt; font-weight: normal; font-size: 11pt; color: {Configuration::get('FSPA_textColor')}; padding-top: 7pt; padding-bottom: 7pt;">
						  				<td style="padding-top: 7pt; padding-bottom: 7pt; padding-left: 5pt">{l s='Invoice address' mod='factSpa'}</td>
						  			</tr> 
                            		<tr style="width: 50%;">
                              			<td style="padding-top: 10pt; padding-bottom: 10pt; padding-left: 5pt; font-size: 10pt; color:#404040"><div style="line-height: 0.8pt">&nbsp;</div>{$invoice_address}<br/>
										</td>
									</tr>
								</table>
          					</td>
						</tr>
					</table>
				{/if}
			</td>
		</tr>
    </table>

  
  
  <!-- / ADDRESSES -->
	<div style="line-height: 2pt">&nbsp;</div>

	<!-- PRODUCTS TAB -->

	<table style="width: 100%">
		<tr style="border-collapse: separate; border-spacing: 1pt;">
			<td style="text-align: right">
				<table style="width: 100%; font-size: 8pt; vertical-align:central; border-collapse: separate; border-spacing: 1.4pt;">
				    <tr style="line-height: 1.6pt;  font-size: 9pt; text-align:left; vertical-align:top; background-color: #F2F2F2;">
						<td colspan="2" style="padding-top: 7pt; padding-bottom: 7pt; color:#000000;">{l s='Order reference:' mod='factSpa'} {$order->getUniqReference()}
						</td>
					</tr> 
                    {foreach from=$order_invoice->getOrderPaymentCollection() item=payment}          
                		<tr style="line-height: 1.6pt;  font-size: 9pt; text-align:left; vertical-align:top; background-color: #F2F2F2;">
                			<td colspan="2" style="padding-top: 7pt; padding-bottom: 7pt; color:#000000;">{l s='Payment method:' mod='factSpa'} {$payment->payment_method}</td>
                		</tr>
					{foreachelse}
						<tr>
							<td>{l s='No payment' pdf='true'}</td>
						</tr>
					{/foreach}           
                	<div style="line-height: 0.5pt">&nbsp;</div>
        			<tr style="background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; line-height: 1.7pt; font-size: 12pt; color: {Configuration::get('FSPA_textColor')}; text-align:center">
						  <td colspan="6" style="padding-top: 7pt; padding-bottom: 7pt;">{l s='Order Details' mod='factSpa'}</td>
					</tr>                
                	<tr style="line-height:4px;">
					
	                    <td style="background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align: center;font-size: 9pt; width: {if Configuration::get('FSPA_details') == 1}10%{else}15%{/if}">{l s='Reference' mod='factSpa'}</td>
	                    
	                    <td style="text-align: left; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 10px;font-size: 9pt; width: {if Configuration::get('FSPA_details') == 1}37%{else}47%{/if}">{l s='Product' mod='factSpa'}</td>
	                    
						<!-- unit price tax excluded is mandatory -->
	                    {if Configuration::get('FSPA_details') == 1}
	                    <td style="text-align: center; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 10px;font-size: 7pt; width: 10%">{l s='Price without discount' mod='factSpa'}</td>
						
	                    <td style="text-align: center; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 10px;font-size: 7pt; width: 10%">{l s='Discount' mod='factSpa'}</td>
	                    {/if}
	                    {if !$tax_excluded_display}
							<td style="background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align: center; width: {if Configuration::get('FSPA_details') == 1}10%{else}13%{/if}">{l s='Price' mod='factSpa'}</td>
						{/if}
	                    <td style="text-align: center; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 10px;font-size: 9pt; width: 10%">{l s='Qty' mod='factSpa'}</td>			  
					
					 	<td style="background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align: right; padding-right:2pt;font-size: 9pt; width: {if Configuration::get('FSPA_details') == 1}13%{else}15%{/if}">
							{l s='Total' mod='factSpa'}
							
						</td>
					</tr>
                
                	<!-- PRODUCTS -->
                	{foreach $order_details as $order_detail}
					{cycle values='#FFF,#DDD' assign=bgcolor}
						<tr style="line-height:5px;background-color:#fff;">
                            <td style="text-align: center; width: {if Configuration::get('FSPA_details') == 1}10%{else}15%{/if}; font-size:{if Configuration::get('FSPA_details') == 1}7pt{else}9pt{/if}; color:#404040">
              					<table>
              						<tr>
              							<td>
              								{if empty($order_detail.product_reference)}
												no ref.
											{else}
												{$order_detail.product_reference}
											{/if}
										</td>
									</tr> 
								</table>                  
                  			</td>                  
							
							<td style="text-align: left; width: {if Configuration::get('FSPA_details') == 1}37%{else}47%{/if}; font-size:{if Configuration::get('FSPA_details') == 1}7pt{else}9pt{/if}; color:#404040">{$order_detail.product_name}</td>
		                    
		                    {if Configuration::get('FSPA_details') == 1}
		                        <td style="text-align: center; width: 10%; font-size:9pt; color:#404040">{displayPrice currency=$order->id_currency price=$order_detail.original_product_price}</td>

		                        <td style="text-align: center; width: 10%; font-size:9pt; color:#404040">
		                        {if (isset($order_detail.reduction_amount) && $order_detail.reduction_amount > 0)}
		                            -{displayPrice currency=$order->id_currency price=$order_detail.reduction_amount}
		                        {else if (isset($order_detail.reduction_percent) && $order_detail.reduction_percent > 0)}
		                            -{$order_detail.reduction_percent}%
		                        {else}
		                        --
		                        {/if}</td>
		                    {/if}
							<!-- unit price tax excluded is mandatory -->
				
							<td style="text-align: right; width: {if Configuration::get('FSPA_details') == 1}10%{else}13%{/if}; font-size:9pt; color:#404040">{displayPrice currency=$order->id_currency price=$order_detail.unit_price_tax_excl}
							</td>
					
		                    <td style="text-align: right; width: 10%">
		                    {$order_detail.product_quantity}
							</td>

							<td style="width: 15%; text-align: right;  width: {if Configuration::get('FSPA_details') == 1}13%{else}15%{/if}; font-size:9pt; color:#404040">
								{displayPrice currency=$order->id_currency price=$order_detail.total_price_tax_excl}
							</td>
						</tr>
					{/foreach}
                
					<tr style="line-height:4px;background-color:#fff; ">
                        <td style="line-height:3px; text-align: left; width: 60%; vertical-align: top; font-size:10pt; color:#404040">
							<blockquote></blockquote>
						</td>
						<td style="text-align: right; width: 15%"></td>
					</tr>
				<!-- END PRODUCTS -->	
				</table>
      		</td>
    	</tr>
    </table>
	<!-- / PRODUCTS TAB -->
	
	<div style="line-height: 1pt">&nbsp;</div>
	
	<!-- DESCUENTO Y ENVÍOS -->
	<table style="width:100%; color:#404040">
	<!-- CART RULES -->
		{assign var="shipping_discount_tax_incl" value="0"}
		{foreach $cart_rules as $cart_rule}
		{cycle values='#FFF,#DDD' assign=bgcolor}
			<tr style="line-height:6px;background-color:#fff; text-align=left; width:100%">
	            <td style=" font-size:10pt; color:#404040; text-align:right; width:75%;">{$cart_rule.name}</td>
				<td style="width:10%"></td>
	            <td style="font-size:10pt; color:#404040; text-align:right; width:15%;">
				{if $cart_rule.free_shipping}
					{assign var="shipping_discount_tax_excl" value=$order_invoice->total_shipping_tax_excl}
				{/if}
				{if $tax_excluded_display}
					- {displayPrice currency=$order->id_currency price=($cart_rule.value_tax_excl)}
				{else}
					- {displayPrice currency=$order->id_currency price=($cart_rule.value_tax_excl)}
				{/if}
				</td>
			<tr style="border-collapse:separate; border-spacing: 4.5pt; font-size:10pt; color:#404040; line-height:2pt">
				<td style="width:75%; text-align:right">{l s='Total Vouchers' pdf='true'}</td>
				<td style="width:10%"></td>
				<td style="width:15%; text-align:right">-{displayPrice currency=$order->id_currency price=($order_invoice->total_discount_tax_excl + $shipping_discount_tax_excl)}</td>
			</tr>

			{if $order_invoice->total_wrapping_tax_incl > 0}
				<tr style="border-collapse:separate; border-spacing: 4.5pt; font-size:10pt; color:#404040; line-height:2pt">
					<td style="text-align: right;  width:75%">{l s='Wrapping Cost' pdf='true'}</td>
	                <td style="width:10%"></td>
					<td style="width: 15%; text-align: right;">
					{if $tax_excluded_display}
						{displayPrice currency=$order->id_currency price=$order_invoice->total_wrapping_tax_excl}
					{else}
						{displayPrice currency=$order->id_currency price=$order_invoice->total_wrapping_tax_incl}
					{/if}
					</td>
				</tr>
			{/if}

			<div style="line-height: 1pt">&nbsp;</div>

		{/foreach}
		<!-- END CART RULES -->
		<tr style="border-collapse:separate; border-spacing: 4.5pt; font-size:10pt; color:#404040; line-height:2pt">
			<td style="width:75%; text-align:right">{l s='Shipping Cost' pdf='true'} - {l s='Carrier:' mod='factSpa'} {$order_invoice->getCarrier($order_invoice->id)->name}</td>
			<td style="width:10%"></td>
			<td style="width:15%; text-align:right">
				{if $tax_excluded_display}
					{displayPrice currency=$order->id_currency price=$order_invoice->total_shipping_tax_excl}
				{else}
					{displayPrice currency=$order->id_currency price=$order_invoice->total_shipping_tax_incl}
				{/if}
			</td>
		</tr>
	</table>

	<!-- / DESCUENTO Y ENVÍOS -->

	<!-- / DETALLES COMPLEMENTARIOS -->



	<div style="line-height: 3pt">&nbsp;</div>

	{$tax_tab}

	{if isset($order_invoice->note) && $order_invoice->note}

	<table style="width: 100%">
		<tr>
			<td style="width: 15%"></td>
			<td style="width: 85%">{$order_invoice->note|nl2br}</td>
		</tr>
	</table>
	{/if}

	{if isset($HOOK_DISPLAY_PDF)}
	<div style="line-height: 1pt">&nbsp;</div>
	<table style="width: 100%">
		<tr>
			<td style="width: 15%"></td>
			<td style="width: 85%">{$HOOK_DISPLAY_PDF}</td>
		</tr>
	</table>



	</div>
	{/if}