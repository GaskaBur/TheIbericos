<div class="oj-slide large-12 columns row">
  <!-- Orbit Container -->
  <div class="orbit-container ">
    <ul data-orbit="" class="orbit-slides-container" data-options="timer_speed:3500; animation_speed: 700;
 bullets:false; stack_on_small:true;" >
        {foreach key=k item=i from=$diapositivas}
          <li>
            <div class="large-8 columns">
               <a href="{$i['url']}" title="{$i['url_text']}">
                  <img src="{$i['img_url']}">
                </a>
            </div>
            <div class="large-4 columns">
                <h3><a href="{$i['url']}" title="{$i['url_text']}">{$i['title']}</a></h3>
                <p>{$i['description']}</p>
            </div>
          <!--<div class="orbit-caption">...</div>-->
          </li> 
        {/foreach} 
      </ul>
    </div>
</div>	

