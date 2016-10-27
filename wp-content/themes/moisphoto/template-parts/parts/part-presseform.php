

  <form id="pressform" role="search" method="get" class="clearfix row search-form-bar" action="<?php echo home_url( '/' ); ?>">

    <div class="m-6col">
      <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Tapez votre recherche ici_', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
    </div>
                
    <div class="pict--search m-1col square">
      <div class="square__content">
        <div class="table">
          <label class="table-cell pict__content icon-search" ></label>
          <input type="submit" id="searchsubmit" value="" />
        </div>
      </div>
    </div>
                
  </form>



