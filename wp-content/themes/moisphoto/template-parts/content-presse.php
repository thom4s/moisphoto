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

  $dp_pdf = get_field('dp_pdf');
  $visuels_zip = get_field('visuels_zip');


?>




<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <div class="row wrap">


    <header class="page__header">
      <div class="has-bordertop--big clearfix"></div>   
      <h1 class="h1"><?php the_title(); ?></h1>
    </header><!-- .entry-header -->


    <?php if ( ! post_password_required() ) : ?>



    <div class="page__content">
      <?php the_content(); ?>

      <div class="s-20col m-12col searchbar--press">
        <h3 class="h5 has-bordertop--little"><a target="_blank" href="/telecharger-tous-dp">Télécharger tous les dossiers de presse en une fois</a>  (ne comprend pas les visuels). Attention, le chargement peut prendre quelques minutes suivant l'état de la connection.</h3>
        
      </div>

      <div class="clearfix s-20col m-11col searchbar--press">
        <h3 class="h5 has-bordertop--little">Téléchargez les éléments presse par expostion</h3>
        <?php get_template_part('template-parts/parts/part-presseform'); ?>
      </div>
          

      <div id="press__list" class="clearfix m-16col press__list">

            <?php 

              $args = array(
                'posts_per_page'  => -1,
                'post_type' => array('event'),
                'event-type'          => 'exposition',
                'post_status'       => 'publish',
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
                    <?php if( $dp_pdf || $visuels_zip ) : ?>
                      <p class="press__btn">
                        <span class="p--strong">Téléchargez :  </span>
                        <?php if( $dp_pdf ) : ?>
                          <a href="<?php the_permalink(); ?>?pdf=" classe="" target="_blank">le DP (.pdf)</a> -  
                        <?php endif; ?> 
                        <?php if( $visuels_zip ) : ?>
                          <a href="?zip=<?php echo $id; ?>" classe="">Les visuels (zip)</a>
                        <?php endif; ?>
                      </p>
                    <?php endif; ?> 
                  </div>
                
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>

              <?php else : ?>
                <p class="no-result"><?php _e( 'Désolé, il n\'y a aucun résultat pour votre recherche.' ); ?></p>

              <?php endif; ?>

          </div>


        <?php else: ?>

          <div class="press__password row">
            <div class="m-10col is-centered  ">
              <?php echo get_the_password_form(); ?> 
            </div>
          </div>
         
        <?php endif; ?>

    </div><!-- .entry-content -->


  
  </div>
</article><!-- #post-## -->




