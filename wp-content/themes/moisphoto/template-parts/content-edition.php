<?php
/**
 * Template part for displaying page content in page-edition.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

// Include and instantiate the class.
// require_once TEMPLATEPATH . '/inc/Mobile_Detect.php';
// $detect = new Mobile_Detect;


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="entry-content clearfix">

    <?php
      if( wp_is_mobile() ) :

        if( have_rows('bouttons_pour_mobile') ): ?>

        <div class="edition__mobile row">
          <div class="is-centered s-16col">

            <?php 
            while ( have_rows('bouttons_pour_mobile') ) : the_row();
                if( get_row_layout() == 'liste_des_expositions' ): ?>

                  <p>
                    <span class=""> > </span> <a href="#" class="<?php the_sub_field('action'); ?> p--big "><?php the_sub_field('texte'); ?></a>
                  </p>

                <?php elseif( get_row_layout() == 'lien_vers_page' ): ?>

                  <p>
                    <span class="icon-google-map pict--map"></span><a href="<?php the_sub_field('page'); ?>" class="p--big"><?php the_sub_field('texte'); ?></a>
                  </p>

                <?php endif;
            endwhile; ?>

          </div> 
        </div>
        <?php endif; ?>
         
    <?php else: ?>

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

  <?php endif; ?>

    <?php 
      // GET GRID ITEMS AND DISPLAY

      $grid_items = get_field('grid');
      set_query_var('grid_items', $grid_items); 
      get_template_part( 'template-parts/modules/module', 'grid' ); 

      // END GRID ?>

    <?php if( get_field('display_news') ) : ?>
    <section class="news-group clearfix">
      <div class="wrap row">
        <?php 
          $news_main = get_field('news_main');
          $number_of_posts = 3;
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

    <?php get_template_part( 'template-parts/modules/module', 'partners' ); ?>


  </div><!-- .entry-content -->
</article><!-- #post-## -->
