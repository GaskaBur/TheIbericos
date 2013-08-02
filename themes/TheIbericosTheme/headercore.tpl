<body {if isset($page_name)}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if} class="{if $hide_left_column}hide-left-column{/if}{if $hide_right_column}hide-right-column{/if}{if $content_only}content_only{/if}">
  	{if isset($restricted_country_mode) && $restricted_country_mode}
		<div id="restricted-country">
			<p>{l s='You cannot place a new order from your country.'} <span class="bold">{$geolocation_country}</span></p>
		</div>
	{/if}
    <div class="web-wrap">
        <div class="web-wrap2">
            <div class="web-container row">
            	<div class="large-3 columns">
	            	<header class="web-main-header row">
	                    <a id="header_logo" href="{$base_dir}" title="{$shop_name|escape:'htmlall':'UTF-8'}">
	                        <img class="logo" src="{$logo_url}" alt="{$shop_name|escape:'htmlall':'UTF-8'}" {if $logo_image_width}width="{$logo_image_width}"{/if} {if $logo_image_height}height="{$logo_image_height}" {/if} />
	                        <h2 class="web-site-title">{$shop_name|escape:'htmlall':'UTF-8'}</h2>
	                    </a>
	                    <h5 class="web-site-tagline">{l s='The Shop Online'}</h5>
	
	                </header>
            	</div> 
				<div class="htop large-9 columns ">
					<div class="row">  
	                	{$HOOK_TOP} <!-- Cualquier combinación de módulos mientras sumen large-12 ;) -->
	                </div>
				</div>
				<div class="hright large-12 columns">
	                <div class=" row">         
	                    {$HOOK_RIGHT_COLUMN} <!-- Cualquier combinación de módulos mientras sumen large-12 ;) -->

	                </div>
				</div>
				{if isset($product)} {* <-- Si estamos en la ficha de producto, nos comemos el Hook_left *}
				<div class="web-main large-12 columns"> 
                                    
                    <div class="web-main-content row" id="center_column">
				{else}
                <div class="web-sidebar large-3 columns">
                    <aside class="web-aside row">
                        {$HOOK_LEFT_COLUMN}  <!-- Recomendable que todos sean large-12 ;) -->                      
                    </aside>    
                </div>

                <div class="web-main large-9 columns">  
                                    
                    <div class="web-main-content row" id="center_column">
                {/if}               