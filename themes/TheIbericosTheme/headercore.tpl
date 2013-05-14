<body {if isset($page_name)}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if} class="{if $hide_left_column}hide-left-column{/if} {if $hide_right_column}hide-right-column{/if} {if $content_only} content_only {/if}">

<div class="oj-wrap banda">
	<div class="oj-main-container">
        <header id="header" class="oj-main-header row">
            <div class="oj-branding large-9 columns">
                <div class="oj-logo">
                    <h2><a href="{$base_dir}" title="{$shop_name|escape:'htmlall':'UTF-8'}">{$shop_name|escape:'htmlall':'UTF-8'}</a></h2>
                </div>
                <h3>La mejor selección de <span>productos gourmet</span></h3>
                <div class="oj-grupo">
                    <a href="http://grupojeda.com" title="Grupo Ojeda" target="_blank" title="Delicatessen Ojeda pertenece a Grupo Ojeda">Grupo OJEDA</a>
                </div>
            </div><!-- oj-branding -->   
            <div id="header_right" class="large-3 columns">
                {$HOOK_TOP}
            </div> 
        </header> <!-- main-header --> 		

        {$HOOK_MENU_TOP_OJEDA}
        <div class="oj-main-content row">
            <div id="center_column" class="">
                {$HOOK_MENU_OJEDA_CATEGORIES}
                