<div class="oj-tmenu row">     
    <div class="oj-search large-6 columns"> 
        <form method="get" action="{$link->getPageLink('search')}" id="searchbox">
            <input type="hidden" name="controller" value="search" />
            <input type="hidden" value="position" name="orderby"/>
            <input type="hidden" value="desc" name="orderway"/>
            <div class="row collapse">
                <div class="large-2 columns inline">
                    <label for="search_query_top"><h5>Buscar</h5></label>
                </div>
                <div class="large-7 columns inline">
                    <input type="text" id="" name="search_query" value="{if isset($smarty.get.search_query)}{$smarty.get.search_query|escape:'htmlall':'UTF-8'}{/if}" class="input" />
                </div>
                <div class="large-3 columns inline">
                    <input type="submit" name="submit_search" value="Encontrar" class="button small" />
                </div>
            </div>
		</form> 
    </div>
    <nav class="oj-secondary-nav large-6 columns">         
        <ul class="top-bar">        	
            <li><a title="{$meta_title|escape:'htmlall':'UTF-8'}" href="{$base_dir}">Inicio</a></li>            
            <li><a title="Quiénes somos" href="{$link->getCMSLink('4')}">Quiénes somos</a></li>
            <li><a title="El Blog de Ojeda" href="http://elblogdeojeda.com/" target="_blank" >Blog</a></li>
            <li><a title="Contacta con nosotros" href="{$link->getPageLink('contact')}">Contacto</a></li>
            <li class="tw"><a title="Sigue a Delicatessen Ojeda en Twitter" href="http://twitter.com/CasaOjedaBurgos" target="_blank"></a></li> 
            <li class="fb"><a title="Sigue a Delicatessen Ojeda en Facebook" href="https://www.facebook.com/grupojeda" target="_blank"></a></li>                  
        </ul>
    </nav> <!-- secondary-nav -->
</div>
