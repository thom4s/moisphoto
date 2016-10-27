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
			<?php get_template_part( 'template-parts/modules/module', 'map' ); ?>

		</div>


		<?php get_template_part( 'template-parts/modules/module', 'grid' ); ?>


		<div class="module-news clearfix">
			<div class="wrap row">
				<?php 
					// Define number of posts
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


		<div class="module-partners clearfix">
			<div class="wrap">
				<?php get_template_part( 'template-parts/modules/module', 'partners' ); ?>
			</div>
		</div>


	</div><!-- .entry-content -->


</article><!-- #post-## -->
