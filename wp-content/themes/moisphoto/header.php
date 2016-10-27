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

	<header id="masthead" class="site-header clearfix" role="banner">

		<div class="wrap row clearfix">
			<div class="site-branding--little l-6col">
				
				<?php if( !is_front_page() && !is_home() ) : ?>
					<div class="site-logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_little.png">
						</a>
					</div>

				<?php else : ?>
					<div class="row">
						<div class="l-1col square">
							<div class="square__content"> &nbsp; </div>
						</div>				
					</div>

				<?php endif; ?>
			</div>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

					<div class="pict--search square l-1col l-last">
						<div class="square__content">
							<div class="table">
								<a class="pict__content table-cell js-open-searchbar icon-search" href="#"> </a>
							</div>
						</div>
					</div>

					<div class="pict--wpml square l-1col l-last">
						<div class="square__content">
							<div class="table">
								<span class="pict__content table-cell"> <?php do_action('display_languages'); ?></span>	
							</div>
						</div>				
					</div>

					<div class="pict--social square l-1col l-last">
						<div class="square__content">
							<div class="table">
								<a class="pict__content icon-twitter table-cell"> </a>
							</div>
						</div>
					</div>
					
					<div class="pict--social  square l-1col l-last">
						<div class="square__content">
							<div class="table">
								<a class="pict__content icon-facebook table-cell"> </a>
							</div>
						</div>
					</div>
	
					<div class="pict--social square l-1col l-last">
						<div class="square__content">
							<div class="table">
								<a class="pict__content icon-instagram table-cell"></a>
							</div>
						</div>
					</div>

		      <div id="searchbar" class="l-6col">
		      	<?php get_search_form(); ?>
		      </div>

			</nav><!-- #site-navigation -->
		</div><!-- .row -->
	</header><!-- #masthead -->


	<?php if( is_front_page() ) : ?>
		<div class="wrap">
			<div class="site-branding--big row clearfix">
				<div class="site-logo l-17col"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_big.png"></a></div>
			</div><!-- .site-branding -->
		</div>
	<?php endif; ?>

  <div id="searchresults" class="search__outer"></div>

	<div id="content" class="site-content clearfix">
