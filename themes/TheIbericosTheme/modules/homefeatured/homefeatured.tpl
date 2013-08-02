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
*}

<!-- MODULE Home Featured Products -->
<div class="homefeatured_title large-12 columns">
	<h3 class="title_block"><span>{l s='Featured products' mod='homefeatured'}</span></h3>	
</div>
<div class="large-12 columns">
{if isset($products) AND $products}
			<!--{assign var='liHeight' value=250}
			{assign var='nbItemsPerLine' value=4}
			{assign var='nbLi' value=$products|@count}
			{math equation="nbLi/nbItemsPerLine" nbLi=$nbLi nbItemsPerLine=$nbItemsPerLine assign=nbLines}
			{math equation="nbLines*liHeight" nbLines=$nbLines|ceil liHeight=$liHeight assign=ulHeight}-->
			<ul class="prod-list large-block-grid-3">
			
			{foreach from=$products item=product name=homeFeaturedProducts}
				<!--{math equation="(total%perLine)" total=$smarty.foreach.homeFeaturedProducts.total perLine=$nbItemsPerLine assign=totModulo}
				{if $totModulo == 0}{assign var='totModulo' value=$nbItemsPerLine}{/if}-->
				<li>
					<div class="prod-item ajax_block_product">
						<a class="product_img_link" href="{$product.link}" title="{$product.name|escape:'htmlall':'UTF-8'}" ><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')}" alt="{$product.name|escape:'htmlall':'UTF-8'}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} /></a>
						<h3><a class="" href="{$product.link}" title="{$product.name|escape:'htmlall':'UTF-8'}"><span>{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}</span></a></h3>
						
						<div class="prod-buy">
							<div class="prod-price content_price">
				            	<span>
				            		{if !$priceDisplay}
				            			{convertPrice price=$product.price}
			            			{else}
			            				{convertPrice price=$product.price_tax_exc}
		            				{/if}
				            	</span>
				            </div>
				            <div class="prod-action row collapse">
				            	<div class="prod-quant large-3 columns">
				            		<input type="text" id="cuantosQuieres_{$product.id_product|intval}" value="1"/>
				            		<small>{l s='Quantity' mod='homefeatured'}</small>
								</div>
				            	<div class="large-9 columns"> 
									<a class="exclusive ajax_add_to_cart_button button prefix" rel="ajax_id_product_{$product.id_product}" href="{$link->getPageLink('cart')}?qty=1&amp;id_product={$product.id_product}&amp;token={$static_token}&amp;add" title="{l s='Add to cart' mod='homefeatured'}">{l s='Add to cart' mod='homefeatured'}</a>
				            	</div>
				            </div>
						</div> <!-- prod-buy -->
					</div>
		        </li>
				
			{/foreach}
			</ul>
		
	{else}
		<p>{l s='No featured products' mod='homefeatured'}</p>
	{/if}
    <div class="row">
    <div class="large-6 columns web-recom">
    	<a href="{$link->getCategoryLink('2', 'productos-delicatessen-recomendados')}" title="{l s='' mod='homefeatured'}" ></a>
    </div>
    </div>
</div>
