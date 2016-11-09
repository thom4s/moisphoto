<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

  $evenements_lies = get_field('evenements_lies');  


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">


    <?php if ( has_post_thumbnail() ) : ?>
      <div class="entry__media bg--img" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div>
    <?php endif; ?>

    <div class="wrap">
			<header class="entry__header m-14col is-centered clearfix">

				<h1 class="h1 entry__title">
					<?php the_title(); ?>
				</h1>	

        <div class="entry__excerpt">
          <?php if( 'post' == get_post_type() ) :  ?>
            <p><span class="p--strong"><?php echo get_the_date('d/m/Y'); ?></span> - <span class="small">Par <?php the_author(); ?></span></p>

          <?php elseif( 'page' == get_post_type() ) : 

            the_field('chapo');

          endif; ?>
        </div>
			</header><!-- .entry-header -->
		</div>

		<div class="wrap">
			<div class="entry__content m-14col is-centered clearfix">
				<?php	the_content(); ?>
			</div><!-- .entry-content -->
		</div>


        <?php if($evenements_lies) : ?>
          <div class="part" id="rebonds" title="Autour de l'exposition"></div>
          <?php 
            set_query_var('rebonds', $evenements_lies); 
            get_template_part( 'template-parts/modules/module', 'rebonds' ); ?>
        <?php endif; ?>



	</div>
</article><!-- #post-## -->
