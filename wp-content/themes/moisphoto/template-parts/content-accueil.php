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

		<div class="module-map clearfix">
			<?php 
				// get current edition
				// get all events of current edition
				// set_query_var('e', $events); 
			?>
			<?php get_template_part( 'template-parts/modules/module', 'map' ); ?>

		</div>


		<div class="module-grid clearfix">
			<div class="wrap">

				<?php 
					// get elements from template
					// set_query_var('e', $elements); 
				?>
				<?php get_template_part( 'template-parts/modules/module', 'grid' ); ?>

			</div>
		</div>


		<div class="module-news clearfix">
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
		</div>


		<div class="module-partners clearfix">
			<div class="wrap">
				<?php get_template_part( 'template-parts/modules/module', 'partners' ); ?>
			</div>
		</div>


	</div><!-- .entry-content -->


</article><!-- #post-## -->
