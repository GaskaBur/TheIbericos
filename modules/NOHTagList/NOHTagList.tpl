<h4>{Configuration::get('NOHTL_titulo')}</h4>
<ul>
	{foreach from=$pr item=product name=myLoop}
		<li>{$smarty.foreach.myLoop.iteration}. <a href="{{$link->getProductLink($product.id_product)}}" title="{$product.name|escape:'htmlall':'UTF-8'}"><span>{$product.name|strip_tags:'UTF-8'|escape:'htmlall':'UTF-8'|truncate:25:"..":true}</span></a><span>{displayPrice price=Product::getPriceStatic($product.id_product) currency=$order->id_currency}</span></li>
	{/foreach}
</ul>