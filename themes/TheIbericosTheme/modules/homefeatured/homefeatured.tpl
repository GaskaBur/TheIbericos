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
<div class="oj-enunciado large-12 columns">
<h3 class=""><span> Productos recomendados </span></h3>	
</div>
<div class="oj-prod row">
{if isset($products) AND $products}
			<!--{assign var='liHeight' value=250}
			{assign var='nbItemsPerLine' value=4}
			{assign var='nbLi' value=$products|@count}
			{math equation="nbLi/nbItemsPerLine" nbLi=$nbLi nbItemsPerLine=$nbItemsPerLine assign=nbLines}
			{math equation="nbLines*liHeight" nbLines=$nbLines|ceil liHeight=$liHeight assign=ulHeight}-->
			<ul class="oj-productos row collapse large-12 columns large-block-grid-4">
			
			{foreach from=$products item=product name=homeFeaturedProducts}
				<!--{math equation="(total%perLine)" total=$smarty.foreach.homeFeaturedProducts.total perLine=$nbItemsPerLine assign=totModulo}
				{if $totModulo == 0}{assign var='totModulo' value=$nbItemsPerLine}{/if}-->
				<li class="">
                <div class="oj-prod-contenedor">
					<a class="oj-prodpic product_img_link" href="{$product.link}" title="{$product.name|escape:'htmlall':'UTF-8'}" ><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')}" alt="{$product.name|escape:'htmlall':'UTF-8'}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} /></a>
					<div class="precio content_price">
		            	<span>
		            		{if !$priceDisplay}
		            			{convertPrice price=$product.price}
	            			{else}
	            				{convertPrice price=$product.price_tax_exc}
            				{/if}
		            	</span>
		            </div>
		            <a class="oj-prodtitle" href="{$product.link}" title=""	><span>{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}</span></a>
		            <a class="button compra" href="{$link->getPageLink('cart')}?qty=1&amp;id_product={$product.id_product}&amp;token={$static_token}&amp;add" title="a la cesta">Añadir a la cesta</a>
                    </div> <!-- oj-prod-contenedor -->
		        </li>
				
			{/foreach}
			</ul>
		
	{else}
		<p>{l s='No featured products' mod='homefeatured'}</p>
	{/if}
    <div class="row">
    <div class="large-6 columns oj-recom">
    	<a href="{$link->getCategoryLink('2', 'productos-delicatessen-recomendados')}" title="Ver todos los productos recomendados de Delicatessen Ojeda" >Ver todos los <strong>productos recomendados</strong> de Delicatessen Ojeda »</a>
    </div>
    </div>
</div>
