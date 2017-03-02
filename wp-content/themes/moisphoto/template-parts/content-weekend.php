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

  <header class="page__header">
    <div class="wrap row">
      
      <div class="has-bordertop--big clearfix"></div>
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
        $color_we = get_field('color');
        $color_we = str_replace('#', '', $color_we); 

        foreach ($events as $e) {
          $type = wp_get_post_terms( $e, 'event-type', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'slugs') );
          if( in_array("exposition", $type) ) {
            $places_events_array[$e] = array( get_field('lieu', $e), $color_we );            
          }
        }    

        set_query_var('events', $events); 
        set_query_var('places_events_array', $places_events_array); 
        set_query_var('is_weekend', $is_weekend); 

				get_template_part( 'template-parts/modules/module', 'map' ); ?>

    </div>


    <?php if(get_field('grid')) :  ?>

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
    <?php endif; ?>

    <section class="event__rebonds clearfix">
      <div class="wrap row">

        <div class="has-bordertop--big clearfix"></div>   
        <h3 class="h2 clearfix">Les événements du weekend</h3>

        <div class="m-20col is-centered">
          <div class="row">

          <?php 
            if($events) {

              $i = 1;

              foreach ($events as $e) : 

                $clearfix = ''; 

                if( $i%3 == 0 ) : 
                  $push = '2';
                  $i = 1;

                elseif( $i%2 == 0 ) : 
                  $push = '1';
                  $i++;

                else : 
                  $push = '0';
                  $clearfix = 'clearfix';
                  $i++;

                endif;  

                set_query_var('e', $e); 
                set_query_var('push', $push); 
                set_query_var('clearfix', $clearfix); 
                get_template_part('template-parts/parts/part', 'item'); ?>

              <?php  endforeach; 
            
            } ?>
          </div>
        </div>
        
      </div>
    </section><!-- .event__rebonds -->


    <?php if( get_field('display_news') ) : ?>
    <section class="news-group clearfix">
      <div class="wrap row">
        <?php 
          $number_of_posts = 4;
          set_query_var('category', 'weekend'); 
          set_query_var('number_of_posts', $number_of_posts); 
          set_query_var('news_main', $news_main); 
        ?>
        <div class="m-16col">
          <?php get_template_part( 'template-parts/modules/module', 'news' ); ?>
        </div>

        <div class="m-6col m-last"> 
          <?php 
            $number_of_item = 4;
            set_query_var('number_of_item', $number_of_item); 
          ?>
          <?php get_template_part( 'template-parts/modules/module', 'stream' ); ?>
        </div>
      </div>  
    </section>
    <?php endif; ?>


    <?php //get_template_part( 'template-parts/modules/module', 'partners' ); ?>



  </div><!-- .entry-content -->


</article><!-- #post-## -->
