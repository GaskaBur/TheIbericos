{if isset($OjedaCategory)}
<div class="oj-menu row collapse">
    <div class="oj-cat large-4 columns">
    	<img src="{$img_cat_dir}{$OjedaCategory}.jpg" alt="" id="ojeda_categoria_img">
        <h3 id="ojeda_categoria_name"><span>{$OjedaCategoryName}</span></h3>
    </div>
    <nav class="oj-main-nav large-8 columns ">
       <ul class="nav-bar">
           	{foreach from=$categories item=cat}				
					<li class="item {if $cat['cat']['id_category'] == $OjedaCategory}active{/if}" id="ojedaCat_{$cat['cat']['id_category']}">
						<a title="{$cat['cat']['name']}" href="{$link->getCategoryLink($cat['cat']['id_category'])}" class="large-4 columns"><span>{$cat['cat']['name']}</span></a>
						{if $cat['cat']['subCat']|@count > 0 }
							<ul class="oj-main-nav2 active" {if $cat['cat']['id_category'] == $OjedaCategory}style="display:block;"{/if}>
							{foreach from=$cat['cat']['subCat'] item=subcat}
								{if $subcat['id_category'] == $OjedaCategory}
									<script>
										document.getElementById("ojedaCat_{$cat['cat']['id_category']}").setAttribute('class','item active');
										document.getElementById("ojeda_categoria_img").setAttribute("src","{$img_cat_dir}{$cat['cat']['id_category']}.jpg");										
										document.getElementById("ojeda_categoria_name").innerHTML = "{$cat['cat']['name']}";
									</script>
								{/if}

							  	<li class="subitem {if $subcat['id_category'] == $OjedaCategory}active{/if}"><a title="" href="{$link->getCategoryLink($subcat['id_category'])}"><span>{$subcat['name']}</span></a></li>
							{/foreach}
							</ul>
						{/if}
					</li>				
			{/foreach}            
        </ul><!-- nav-bar -->
        <div class="oj-cattext">Elige una de las categorías para descubrir todos los productos gourment que Ojeda ofrece</div>
    </nav>
</div>
{else}
<div class="oj-menu row collapse">
	<div class="oj-cat large-4 columns ">
		<h3 id="ojeda_categoria_name"><span>Categorías Delicatessen »</span></h3>
	</div>

	<nav class="oj-main-nav large-8 columns ">
	    <ul class="nav-bar">
	    	{foreach from=$categories item=cat}
				
					<li class="item"><a title="{$cat['cat']['name']}" href="{$link->getCategoryLink($cat['cat']['id_category'])}" class="large-4 columns"><span>{$cat['cat']['name']}</span></a></li>
					{if $cat['cat']['subCat']|@count > 0 }
						<ul class="oj-main-nav2">
						{foreach from=$cat['cat']['subCat'] item=subcat}
						  	<li class="subitem"><a title="" href="#"><span>{$subcat['name']}</span></a></li>
						{/foreach}
						</ul>
					{/if}
				
			{/foreach}
	    </ul><!-- nav-bar -->
	    <div class="oj-cattext">Elige una de las categorías para descubrir todos los productos gourment que Ojeda ofrece</div>
	</nav><!-- sp-main-nav -->

</div> <!-- oj-menu -->
{/if}