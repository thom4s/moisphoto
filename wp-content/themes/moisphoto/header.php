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
<meta name="google-site-verification" content="yIod8nwCkjV4eAiryQ7RSi3-dmiUU_20Z11hhfVtQdo" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header wrap clearfix" role="banner">

		<div class="row clearfix">

			<div class="site-branding--little l-6col">
				&nbsp; 
				<?php if( !is_front_page() && !is_home() ) : ?>
					
					<div class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_big.png"> </a></div>

				<?php endif; ?>
			</div>



			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

					<div class="pict--search l-1col l-last">
						<span class="pict__content">s</span>
					</div>

					<div class="pict--wpml l-1col l-last">
						<span class="pict__content">EN</span>
					</div>

					<div class="pict--social l-1col l-last">
						<span class="pict__content">t</span>
					</div>
					
					<div class="pict--social l-1col l-last">
						<span class="pict__content">t</span>
					</div>
					
					<div class="pict--social l-1col l-last">
						<span class="pict__content">t</span>
					</div>
					
			</nav><!-- #site-navigation -->

		</div><!-- .row -->



		<?php if( is_front_page() ) : ?>
			<div class="site-branding--big row clearfix">
				<div class="site-logo l-17col"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_big.png"></a></div>
			</div><!-- .site-branding -->
		<?php endif; ?>


	</header><!-- #masthead -->

	<div id="content" class="site-content wrap clearfix">
