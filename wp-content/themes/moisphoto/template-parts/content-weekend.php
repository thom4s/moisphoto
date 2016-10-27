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

  <header class="entry-header">
    <div class="wrap row">
      
      <h1><?php the_title(); ?></h1>
    
      <div class="m-12col">
        <?php the_content(); ?>
      </div>
    
    </div>
  </header>

  <div class="entry-content clearfix">

    <div class="module-map clearfix">
      <?php 
        $events = array();
        $places = array();
        $events = get_field('events_list');

        foreach ($events as $e) {
          $places_events_array[$e] = get_field('lieu', $e);
        }    

        set_query_var('events', $events); 
        set_query_var('places_events_array', $places_events_array); 
				
				get_template_part( 'template-parts/modules/module', 'map' ); ?>

    </div>


    <div class="module-grid clearfix">
      <div class="wrap">

        <?php 
          $grid_items = get_field('grid');
          set_query_var('grid_items', $grid_items); 
          if($grid_items) {
            get_template_part( 'template-parts/modules/module', 'grid' ); 
          } ?>

      </div>
    </div>


    <div class="module-news clearfix">
      <div class="wrap row">
        <?php 
          // Define number of posts
          // Define category post
          // set_query_var('p', $posts); 
        ?>
        <div class="m-16col">
          <?php get_template_part( 'template-parts/modules/module', 'news' ); ?>
        </div>

        <div class="m-8col">
        <?php 
          // Define number of items
          // set_query_var('i', $items); 
        ?>
        <?php get_template_part( 'template-parts/modules/module', 'stream' ); ?>
        </div>
      </div>  
    </div>


    <?php get_template_part( 'template-parts/modules/module', 'partners' ); ?>



  </div><!-- .entry-content -->


</article><!-- #post-## -->
