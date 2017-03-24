<?php
/**
 * Template part for displaying page content in page-edition.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="entry-content clearfix">

    <?php the_content(); ?>

    <?php get_template_part( 'template-parts/modules/module', 'partners' ); ?>

  </div><!-- .entry-content -->
</article><!-- #post-## -->
