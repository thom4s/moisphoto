<?php 
/**
 * Search form
 *
 * @package bourron
 */

?>


              <form id="searchform" role="search" method="get" class="clearfix row search-form-bar" action="<?php echo home_url( '/' ); ?>">

                <div class="close s-2col m-1col square">
                  <div class="square__content">
                    <div class="table">
                      <a href="#" class="js-close table-cell"></a>
                    </div>
                  </div>              
                </div>

                <div class="s-20col m-4col">
                  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Tapez votre recherche ici_', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                </div>
                
                <div class="pict--search s-2col m-1col square">
                  <div class="square__content">
                    <div class="table">
                      <label class="table-cell pict__content icon-search" ></label>
                      <input type="submit" id="searchsubmit" value="" />
                    </div>
                  </div>
                </div>
                
              </form>