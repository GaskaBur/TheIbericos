<h4>{Configuration::get('NOHCL2_titulo')}</h4>
<ul>
	{foreach from=$pr item=product name=myLoop}
		<li>{$smarty.foreach.myLoop.iteration}. <a href="{$link->getProductLink($product->id)}" title="{$product->name[1]}"><span>{$product->name[1]}</span></a> <span>{displayPrice price=$product->getPriceStatic($product->id) currency=$order->id_currency}</span></li>
	{/foreach}
</ul