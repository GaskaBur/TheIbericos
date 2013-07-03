<div class="web-modulo large-12 columns">
<h4>{l s='The Ibéricos Select' mod='NOHCustomList'}</h4>
<h5>{l s='Recomendados del mes' mod='NOHCustomList'}</h5>
<ul>
	{foreach from=$pr item=product name=myLoop}
		<li>
			<a href="{$link->getProductLink($product->id)}" title="{$product->name[4]}">
				<img id="thumb_{$image.id_image}" src="{$link->getImageLink($product->link_rewrite, $product->id, 'medium_default')}" alt="{$image.legend|htmlspecialchars}"/>
			</a> 
		</li>
	{/foreach}
</ul>
<a href="{$link->getCategoryLink('16')}" >
{l s='Ver Selección' mod='NOHCustomList'}
</a> 
</div>