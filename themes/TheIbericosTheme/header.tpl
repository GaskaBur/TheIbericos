<!DOCTYPE html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" > <!--<![endif]-->
<head>	
	<meta charset="utf-8" />
    <meta http-equiv="content-language" content="{$meta_language}" />
  	<meta name="viewport" content="maximum-scale=1.0; minimum-scale=0.0;" /> 
	<meta name="robots" content="{if isset($nobots)}no{/if}index,{if isset($nofollow) && $nofollow}no{/if}follow" />
	<title>{$meta_title|escape:'htmlall':'UTF-8'}</title>
    {if isset($meta_description) AND $meta_description}
    	<meta name="description" content="{$meta_description|escape:html:'UTF-8'}" />
    {/if}
    {if isset($meta_keywords) AND $meta_keywords}
        <meta name="keywords" content="{$meta_keywords|escape:html:'UTF-8'}" />
    {/if}
    <link rel="icon" type="image/vnd.microsoft.icon" href="{$favicon_url}?{$img_update_time}" />
	<link rel="shortcut icon" type="image/x-icon" href="{$favicon_url}?{$img_update_time}" />
	
	<script type="text/javascript">
			var baseDir = '{$content_dir}';
			var baseUri = '{$base_uri}';
			var static_token = '{$static_token}';
			var token = '{$token}';
			var priceDisplayPrecision = {$priceDisplayPrecision*$currency->decimals};
			var priceDisplayMethod = {$priceDisplay};
			var roundMode = {$roundMode};
	</script>
    
    {if isset($css_files)}
        {foreach from=$css_files key=css_uri item=media}
        	<link href="{$css_uri}" rel="stylesheet" type="text/css" media="{$media}" />
        {/foreach}
    {/if}
    
    {if isset($js_files)}
        {foreach from=$js_files item=js_uri}
        <script type="text/javascript" src="{$js_uri}"></script>
        {/foreach}
    {/if}
    	
    {$HOOK_HEADER }
</head>
    
