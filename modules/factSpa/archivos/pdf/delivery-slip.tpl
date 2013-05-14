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
*  @author PrestaShop SA 
*  @copyright  2007-2012 PrestaShop SA
*  @version  Release: $Revision: 6753 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
<div style="font-size: 9pt; color: #444">

	<table>
		<tr><td>&nbsp;</td></tr>
	</table>

	<!-- ADDRESSES -->
	<table style="width: 100%">
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
       		<td style="width:35%; vertical-align: middle;">
				<table>
					<tr>
  						<td style="font-weight: bold; font-size: 14pt; color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; width: 100%; text-align:right">{l s='Delivery' mod='factSpa'}
  						</td>
  					</tr>
					<tr>
						<td style="font-size: 11pt; font-weight: bold; color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; text-align:right">{$title|escape:'htmlall':'UTF-8'}
						</td>
					</tr>
					<tr>
						<td style="padding-right: 7px; text-align: right; vertical-align: top; font-size: 10pt; color:{if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; ">
							{l s='Order Date:' pdf='true'}: {$order->date_add|date_format:"%d-%m-%Y %H:%M"}
						</td>
			
						<!-- / CUSTOMER INFORMATIONS -->
        			</tr>
        		</table>
        	</td>
        </tr>
        <tr>
		  <td style="width:30%">&nbsp;</td>
		  <td style="width:35%; position:relative">&nbsp;</td>
		  <td style="width:35%; vertical-align: middle;">&nbsp;</td>
		</tr>
    </table>
        
	<table style="width: 100%">
		<tr>
			<td width="80%" style="width: 80%">
			  <table style="width: 100%">
				<tr>
					<td style="width: 50%">
						<table style="width: 100%" >
                            <tr style="width: 50%; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; line-height: 1.5pt; font-weight: normal; font-size: 11pt; color: {Configuration::get('FSPA_textColor')}">
                                 <td style="padding-top: 7pt; padding-bottom: 7pt; padding-left: 5pt">{l s='Delivery Address' mod='factSpa'}</td>
                            </tr>
                            <tr style="width: 50%;">
                                 <td style="padding-top: 10pt; padding-bottom: 10pt; padding-left: 5pt; font-size: 10pt; color:#404040">{$delivery_address}</td>
                             </tr>
                        </table>
                    </td>
                        {if !empty($invoice_address)}
                            <td style="width: 50%">
                            	<table style="width: 100%" >
                               		<tr style="width: 50%; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; line-height: 1.5pt; font-weight: normal; font-size: 11pt; color: {Configuration::get('FSPA_textColor')}">
                                 		<td style="padding-top: 7pt; padding-bottom: 7pt; padding-left: 5pt">{l s='Invoice Address' mod='factSpa'}</td>
                                    </tr>
                               		<tr style="width: 50%;">
                                 		<td style="padding-top: 10pt; padding-bottom: 10pt; padding-left: 5pt; font-size: 10pt; color:#404040">{$invoice_address}</td>
                               		</tr>
                             </table>
                           </td>
                        {/if}
					</tr>
		  		</table>	
			</td>
		</tr>
	</table>
	<!-- / ADDRESSES -->

	<table>
		<tr><td style="line-height: 8px">&nbsp;</td></tr>
	</table>

	<!-- PRODUCTS TAB -->
	<table style="width: 100%">
		<tr>
			<td style="text-align: right">
				<table style="width: 100%">
					<tr style="line-height:6px; font-size:12pt">
						<td style="background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align: left; font-weight: thin; width: 15%">{l s='REFERENCE' pdf='true'}</td>
						<td style="background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; text-align: left; font-weight: thin; width: 15%">{l s='QTY' pdf='true'}</td>
                    	<td style="text-align: left; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; padding-left: 10px; font-weight: thin; width: 70%">{l s='ITEMS TO BE DELIVERED' pdf='true'}</td>
					</tr>
					{foreach $order_details as $product}
					{cycle values='#FFF,#DDD' assign=bgcolor}
					<tr style="line-height:6px;background-color:{$bgcolor};">
						
						<td style="text-align: left; width: 15%">
							{if empty($product.product_reference)}
								---
							{else}
								{$product.product_reference}
							{/if}
						</td>
						<td style="text-align: left; width: 15%">{$product.product_quantity}</td>
	                    <td style="text-align: left; width: 70%">{$product.product_name}</td>
					</tr>
					{/foreach}
				</table>
			</td>
		</tr>
	</table>
	<!-- / PRODUCTS TAB -->

	<!-- MENSAJES -->
	<div style="font-size: 12pt; font-weight:thin; text-align:left; background-color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; color: {Configuration::get('FSPA_textColor')}; width:40%; padding-left:2pt">{l s='Customer message:' mod='factSpa'} &nbsp;</div>
	<table style="width: 100%">
	
    
		{foreach $messages as $mensaje}
		{cycle values='#FFF,#DDD' assign=bgcolor}
	    <tr style="line-height:6px;">
			<td style="text-align: center;  padding-left: 10px;  color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; font-weight: thin; width: 15%">{$mensaje.date_add}</td>
			<td style="color: {if Configuration::get('FSPA_color')}{Configuration::get('FSPA_color')}{else}#000000{/if}; text-align: center; font-weight: thin; width: 80%">{$mensaje.message}</td>
		</tr>
		
		
		{/foreach}
	</table>
	<!-- / MENSAJES -->

	<table>
		<tr><td style="line-height: 8px">&nbsp;</td></tr>
	</table>

	{if isset($HOOK_DISPLAY_PDF)}
		<div style="line-height: 1pt">&nbsp;</div>
		<table style="width: 100%">
			<tr>
				<td style="width: 15%"></td>
				<td style="width: 85%">
					{$HOOK_DISPLAY_PDF}
				</td>
			</tr>
		</table>
	{/if}

	</div>

