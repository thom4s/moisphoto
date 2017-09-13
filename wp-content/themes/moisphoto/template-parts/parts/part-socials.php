          <div class="pict--search square s-2col m-1col s-last">
            <div class="square__content">
              <div class="table">
                <a class="pict__content table-cell js-open-searchbar icon-search" href="#"> </a>
              </div>
            </div>
          </div>

          <div class="pict--wpml square s-2col m-1col s-last">
            <div class="square__content">
              <div class="table">
                <span class="pict__content table-cell"> <?php do_action('display_languages'); ?></span> 
              </div>
            </div>        
          </div>        

          <div class="pict--contact square s-2col m-1col s-last">
            <div class="square__content">
              <div class="table">
                <a href="mailto:contact@moisdelaphotodugrandparis.com/" class="pict__content icon-mail table-cell"></a>
              </div>
            </div>
          </div>

          <div class="pict--fb square s-2col m-1col s-last">
            <div class="square__content">
              <div class="table">
                <a href="<?php echo FACEBOOK_LINK; ?>" target="_blank" class="pict__content icon-facebook table-cell"></a>
              </div>
            </div>
          </div>
  
           <div class="pict--insta square s-2col m-1col s-last">
            <div class="square__content">
              <div class="table">
                <a href="<?php echo INSTAGRAM_LINK; ?>" target="_blank" class="pict__content icon-instagram table-cell"></a>
              </div>
            </div>
          </div> 


          <div class="pict--twitter square s-2col m-1col s-last">
            <div class="square__content">
              <div class="table">
                <a href="<?php echo TWITTER_LINK; ?>" target="_blank" class="pict__content icon-twitter table-cell"> </a>
              </div>
            </div>
          </div> 

          <div id="searchbar" class="searchbar s-24col m-10col">
            <?php get_search_form(); ?>
          </div>