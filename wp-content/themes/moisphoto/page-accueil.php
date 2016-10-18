<?php
/**
 *
 * Template name: Page d'accueil - Edition courante
 *
 * @package moisphoto
 */

  // Get ACF Fields
  $current_edition = get_field('edition_courante'); 
  $grid_items = get_field('grid'); 

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

        set_query_var('current_edition', $current_edition); 
        set_query_var('grid_items', $grid_items); 
				get_template_part( 'template-parts/content', 'edition' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
