<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package moisphoto
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header wrap clearfix" role="banner">

		<div class="row clearfix">

			<div class="site-branding--little l-6col">
				&nbsp; 
				<?php if( !is_front_page() && !is_home() ) : ?>
					
					<div class="site-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_big.png">
						</a>
					</div>

				<?php endif; ?>
			</div>



			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

					<div class="pict--search l-1col l-last">
						<a class="pict__content js-open-searchbar" href="#">s</a>
					</div>

					<div class="pict--wpml l-1col l-last">
						<span class="pict__content"> <?php do_action('display_languages'); ?></span>
					</div>

					<div class="pict--social l-1col l-last">
						<a class="pict__content">t</a>
					</div>
					
					<div class="pict--social l-1col l-last">
						<a class="pict__content">t</a>
					</div>
					
					<div class="pict--social l-1col l-last">
						<a class="pict__content">t</a>
					</div>
					

		      <div id="searchbar" class="l-6col">
		      	<div class="row">
							<div class="close l-1col square">
								<a href="#" class="js-close square__content">x</a>
							</div>

			        <div class="searchbar-inner l-5col table">
			            <div class="table-cell">
			              <?php get_search_form(); ?>
			            </div>
			        </div>

		      	</div>
		      	
		      </div><!-- .row-mesure  -->


			</nav><!-- #site-navigation -->

		</div><!-- .row -->



		<?php if( is_front_page() ) : ?>
			<div class="site-branding--big row clearfix">
				<div class="site-logo l-17col"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_big.png"></a></div>
			</div><!-- .site-branding -->
		<?php endif; ?>


	</header><!-- #masthead -->


  <div id="searchresults"></div>


	<div id="content" class="site-content clearfix">
