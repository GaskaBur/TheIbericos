
	<div >
		<ul class="">
			{foreach from=$pr item=product name=myLoop}
				<li class="large-6 columns">
					<a href="{$link->getCmsLink($product->id)}" title="{$product->meta_title[4]}">
						<span>{$product->meta_title[Context::getContext()->language->id]}</span>					
					</a>					 
				</li>
			{/foreach}
		</ul>
	</div>
	
