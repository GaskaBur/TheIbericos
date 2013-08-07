<div class="web-modulo large-12 columns">
	<nav class="web-menu vertical">
		<ul class="">
			{foreach from=$pr item=product name=myLoop}
				<li class="">
					<a href="{$link->getCmsLink($product->id)}" title="{$product->meta_title[4]}">
						<span>{$product->meta_title[Context::getContext()->language->id]}</span>					
					</a>					 
				</li>
			{/foreach}
		</ul>
	</nav>
</div>	
