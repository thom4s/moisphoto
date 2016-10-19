<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

  if(isset($_GET['zip'])) {
    $id = $_GET['zip'];
    zipThoseFiles($id);
  }

?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="row wrap">


    <header class="entry-header">
      <h1><?php the_title(); ?></h1>
    </header><!-- .entry-header -->



    <div class="entry-content">
      <?php the_content(); ?>
    </div><!-- .entry-content -->


    <?php get_template_part('template-parts/parts/part-presseform'); ?>


    <div id="press__list">

      <?php 

        $args = array(
          'posts_per_page'  => -1,
          'post_type' => array('event'),
        );
  
        $events = new WP_Query( $args );
        
        if ( $events->have_posts() ) : 
          while ( $events->have_posts() ) : $events->the_post(); ?>
          
            <?php
                $auteurs = get_field('auteurs'); 
                $lieu = get_field('lieu');
                $id = $post->ID;
            ?>

            <div class="press__list__item">
              <p><?php moisphoto_get_artists_list($auteurs); ?> - <?php the_title(); ?></p>

              <p><?php echo get_the_title( $lieu ); ?></p>

              <div class="press__btn">
                <a href="#" classe="">pdf</a>
                <a href="?zip=<?php echo $id; ?>" classe="">zip</a>
              </div>

            </div>
          
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>

        <?php else : ?>
          <p class="no-result"><?php _e( 'Désolé, il n\'y a aucun résultat pour votre recherche.' ); ?></p>

        <?php endif; ?>

    </div>

  </div>
</article><!-- #post-## -->
