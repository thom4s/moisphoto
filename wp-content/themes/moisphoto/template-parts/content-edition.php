<?php
/**
 * Template part for displaying page content in page-accueil.php.
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
        
          foreach ($events_list as $e) {
            $events[] = $e;
            $places_events_array[$e] = get_field('lieu', $e);
          }            
        }

      elseif ( $type_relation == 'Événements' ) :
        $events = get_field('evenements', $current_edition);

        foreach ($events as $e) {
          $places_events_array[$e] = get_field('lieu', $e);
        }    

      endif; 

      set_query_var('events', $events); 
      set_query_var('places_events_array', $places_events_array); 

      get_template_part( 'template-parts/modules/module', 'map' ); 

      // END MAP ?>



    <?php 
      // GET GRID ITEMS AND DISPLAY

      $grid_items = get_field('grid');
      set_query_var('grid_items', $grid_items); 
      get_template_part( 'template-parts/modules/module', 'grid' ); 

      // END GRID ?>



    <section class="module-news clearfix">
      <div class="wrap row">
        <?php 
          // Define number of posts
          // set_query_var('p', $posts); 
        ?>
        <div class="l-16col">
          <?php get_template_part( 'template-parts/modules/module', 'news' ); ?>
        </div>

        <div class="l-8col">
        <?php 
          // Define number of items
          // set_query_var('i', $items); 
        ?>
        <?php get_template_part( 'template-parts/modules/module', 'stream' ); ?>
        </div>
      </div>  
    </section>


    <section class="module-partners clearfix">
      <div class="wrap">
        <?php get_template_part( 'template-parts/modules/module', 'partners' ); ?>
      </div>
    </section>


  </div><!-- .entry-content -->


</article><!-- #post-## -->
