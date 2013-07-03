<div class="web-modulo large-12 columns">
	<nav>
		<ul>
			{foreach from=$pr item=product name=myLoop}
				<li><a href="{$link->getCategoryLink($product->id_category)}">{$product->nombre_corto[Context::getContext()->language->id]}</a> </li>
			{/foreach}
		</ul>
	</nav>
</div>