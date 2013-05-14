<h4>{Configuration::get('NOHCL_titulo')}</h4>
<ul>
	{foreach from=$pr item=product name=myLoop}
		<li>{$smarty.foreach.myLoop.iteration}. <a href="{$link->getProductLink($product->id)}" title="{$product->name[4]}"><span>{$product->name[4]|truncate:25:"..":true}</span></a> <span>{displayPrice price=$product->getPriceStatic($product->id) currency=$order->id_currency}</span></li>
	{/foreach}
</ul>