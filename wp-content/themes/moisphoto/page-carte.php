<?php
/**
 *
 * Template name: Carte plein écran
 *
 * @package moisphoto
 */

get_header(); 
?>

	<div id="primary" class="map_fulscreen">
		<main id="main" class="site-main" role="main">
      <a href="<?php bloginfo('url') ?>" id="close-map" class="clearfix close-map"></a>
			
      <?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'carte' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

