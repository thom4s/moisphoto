<?php 
/**
 * Search form
 *
 * @package bourron
 */

?>


<form id="searchform" role="search" method="get" class="search-form-bar" action="<?php echo home_url( '/' ); ?>">

  <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Tapez votre recherche ici_', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />

  <input type="submit" id="searchsubmit" class="btn-inline_green" value="Rechercher" />

</form>
