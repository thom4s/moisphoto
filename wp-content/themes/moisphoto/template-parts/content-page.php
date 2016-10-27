<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">


    <?php if ( has_post_thumbnail() ) : ?>
      <div class="entry__media bg--img" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div>
    <?php endif; ?>

    <div class="wrap">
			<header class="entry__header m-14col is-centered clearfix">

				<h1 class="entry__title">
					<?php the_title(); ?>
				</h1>	

			</header><!-- .entry-header -->
		</div>

		<div class="wrap">
			<div class="entry__content m-14col is-centered clearfix">
				<?php	the_content(); ?>
			</div><!-- .entry-content -->
		</div>

	</div>
</article><!-- #post-## -->
