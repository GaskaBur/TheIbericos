<div id="NOHrecomended" class="web-modulo large-12 columns select">
	<h4>{l s='Selected products' mod='NOHCustomList'}</h4>
	<h5>{l s='Really interesting.' mod='NOHCustomList'}</h5>
	<div class="web-list horizontal row">
		<ul class="">
			{foreach from=$pr item=product name=myLoop}
				<li class="large-6 columns">
					<a href="{$link->getProductLink($product->id)}" title="{$product->name[4]}">
						<span>{$product->name[4]}</span>
                        {assign var="img" value=Product::getCover($product->id)}
						<img id="thumb_{$image.id_image}" src="{$link->getImageLink($product->link_rewrite,$img.id_image, 'small_default')}" alt="{$image.legend|htmlspecialchars}"/>						
					</a>					 
				</li>
			{/foreach}
		</ul>
	</div>
	{if $cat eq ""}
	<a href="{$link->getCategoryLink(2)}" title="{l s='See More products' mod='NOHCustomList'}" class="web-more" >
	{else}
	<a href="{$link->getCategoryLink($cat)}" title="{l s='See More products' mod='NOHCustomList'}" class="web-more" >
	{/if}
	{l s='See More' mod='NOHCustomList'}
	</a> 
</div>