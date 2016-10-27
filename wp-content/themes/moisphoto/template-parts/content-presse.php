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


    <header class="page__header">
      <div class="has-bordertop--big clearfix"></div>   
      <h1 class="h1"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->



    <div class="page__content">
      <?php the_content(); ?>
    </div><!-- .entry-content -->

    <div class="s-20col m-7col searchbar--press">
      <?php get_template_part('template-parts/parts/part-presseform'); ?>
    </div>
    

    <div id="press__list" class="clearfix m-16col press__list">

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
              <p><span class="p--big"><?php moisphoto_get_artists_list($auteurs); ?></span> 
                <span class="p--strong">- <?php the_title(); ?></span>
                <span class=""> | <?php echo get_the_title( $lieu ); ?></span>
              </p>
              <p class="press__btn">
                <span class="p--strong">Téléchargez :  </span>
                <a href="<?php the_permalink(); ?>?pdf=" classe="" target="_blank">le DP (.pdf)</a>
                - <a href="?zip=<?php echo $id; ?>" classe="">Les visuels (zip)</a>
              </p>
            </div>
          
          <?php endwhile; ?>
          <?php wp_reset_postdata(); ?>

        <?php else : ?>
          <p class="no-result"><?php _e( 'Désolé, il n\'y a aucun résultat pour votre recherche.' ); ?></p>

        <?php endif; ?>

    </div>

  </div>
</article><!-- #post-## -->
