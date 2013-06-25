<body {if isset($page_name)}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if} class="{if $hide_left_column}hide-left-column{/if}{if $hide_right_column}hide-right-column{/if}{if $content_only}content_only{/if}">
  
    <div class="web-wrap">
        <div class="web-wrap2">
            <div class="web-container row">

                <div class="web-sidebar large-3 columns">
                    <header class="web-main-header row">
                        <a id="header_logo" href="{$base_dir}" title="{$shop_name|escape:'htmlall':'UTF-8'}">
                            <img class="logo" src="{$logo_url}" alt="{$shop_name|escape:'htmlall':'UTF-8'}" {if $logo_image_width}width="{$logo_image_width}"{/if} {if $logo_image_height}height="{$logo_image_height}" {/if} />
                            <h1 class="web-site-title">The Ibéricos</h1>
                        </a>
                        <h5 class="web-site-tagline">Tu tienda de ibéricos online</h5>

                    </header> 
                    <aside class="web-aside row">
                        {$HOOK_LEFT_COLUMN}
                        <!-- Cada móudlo en anclado a Hook left debe llevar esta estructura.
                        <div class="web-modulo large-12 columns">
                        1
                        </div>              
                        -->
                    </aside>    
                </div>

                <div class="web-main large-9 columns">     
                    <div class="htop row">  
                        {$HOOK_TOP}
                        <!--
                        <div class="web-modulo large-4 columns">
                        1
                        </div>
                        -->
                    </div>
                    <div class="hright row">         
                        {$HOOK_RIGHT_COLUMN}
                        <!--
                        <div class="web-modulo large-8 columns">
                        1
                        </div>
                        <div class="web-modulo large-4 columns">
                        2
                        </div>
                        <div class="web-modulo large-12 columns">
                        3
                        </div>
                        -->
                    </div>


                    
                    <div class="web-main-content row" id="center_column">               