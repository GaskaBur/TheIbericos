<div class="web-modulo large-12 columns">
	<nav class="web-menu vertical">
		<ul class="">
			{foreach from=$pr item=product name=myLoop}
				<li class="cat-{$product->id_category}"><a href="{$link->getCategoryLink($product->id_category)}" title="{$product->nombre_corto[Context::getContext()->language->id]}">{$product->nombre_corto[Context::getContext()->language->id]}</a> </li>
			{/foreach}
		</ul>
	</nav>
</div>