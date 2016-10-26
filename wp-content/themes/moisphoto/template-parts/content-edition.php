<?php
/**
 * Template part for displaying page content in page-edition.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


  <div class="entry-content clearfix">


    <?php 
      // GET MAP ITEMS AND DISPLAY

      $type_relation = get_field('type_relation', $current_edition);      
      $events = array();
      $places = array();

      if( $type_relation == 'Weekends') : 
        $weekends = get_field('weekends',  $current_edition); // ID

        foreach ($weekends as $we) {
          $events_list = get_field('events_list', $we);
          $color_we = get_field('color', $we);
          $color_we = str_replace('#', '', $color_we); 
          
          foreach ($events_list as $e) {
            $events[] = $e;
            $places_events_array[$e] = array( get_field('lieu', $e), $color_we );
          }            
        }
        $is_weekend = true; 

      elseif ( $type_relation == 'Événements' ) :
        $events = get_field('evenements', $current_edition);

        foreach ($events as $e) {
          $places_events_array[$e] = array( get_field('lieu', $e), 'default' );
        }    
        $is_weekend = false; 

      endif; 
        $is_weekend = false; 

      set_query_var('events', $events); 
      set_query_var('places_events_array', $places_events_array); 
      set_query_var('is_weekend', $is_weekend); 

      get_template_part( 'template-parts/modules/module', 'map' ); 

      // END MAP ?>



    <?php 
      // GET GRID ITEMS AND DISPLAY

      $grid_items = get_field('grid');
      set_query_var('grid_items', $grid_items); 
      get_template_part( 'template-parts/modules/module', 'grid' ); 

      // END GRID ?>


    <section class="news-group clearfix">
      <div class="wrap row">
        <?php 
          $news_main = get_field('news_main');
          $number_of_posts = 3;
          set_query_var('number_of_posts', $number_of_posts); 
          set_query_var('news_main', $news_main); 
        ?>
        <div class="l-16col">
          <?php get_template_part( 'template-parts/modules/module', 'news' ); ?>
        </div>

        <div class="l-6col l-last">
          <?php 
            $number_of_item = 4;
            set_query_var('number_of_item', $number_of_item); 
          ?>
          <?php get_template_part( 'template-parts/modules/module', 'stream' ); ?>
        </div>
      </div>  
    </section>


    <?php get_template_part( 'template-parts/modules/module', 'partners' ); ?>


  </div><!-- .entry-content -->
</article><!-- #post-## -->
