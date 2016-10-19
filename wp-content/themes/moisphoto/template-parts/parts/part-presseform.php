

<form id="pressform" role="search" method="get" class="" action="<?php echo home_url( '/' ); ?>">

  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Affiner les résultats', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />

  <input type="submit" id="pressform__submit" class="" value="Rechercher" />

</form>
