<?php
/**
 * The header for our theme.
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
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicon.png" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<?php if( !is_page_template( 'page-carte.php' ) ) : ?>

	<header id="masthead" class="site-header clearfix" role="banner">

		<div class="wrap row clearfix">
			<div class="site-branding--little s-5col m-6col">
				
				<?php if( !is_front_page() && !is_home() ) : ?>
					<div class="site-logo--little">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_little.png">
						</a>
					</div>

				<?php else : ?>
					<div class="site-logo--little">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_little.png">
						</a>
					</div>

				<?php endif; ?>
			</div>


			<div class="s-18col s-last mobile_nav ">
				<div class="row">

					<div class="mobile_nav__socials ">
						<?php get_template_part( 'template-parts/parts/part', 'socials' ); ?>
					</div>


          <div class="pict--mobilemenu square s-2col s-3col-pusht">
            <div class="square__content">
              <div class="table">
                <a id="mobile_nav__trigger" class="pict__content icon-header-mobile-menu table-cell"></a>
              </div>
            </div>
          </div>


				</div>
				<!-- <a id="mobile_nav__trigger" class="clearfix mobile_nav__trigger"><span class="arrow--little--black">></span>Menu</a> -->
			</div>


			<nav id="site-navigation" class="main-navigation" role="navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

				<div class="main-nav__socials">
					<?php get_template_part( 'template-parts/parts/part', 'socials' ); ?>
				</div>

			</nav><!-- #site-navigation -->
		</div><!-- .row -->
	</header><!-- #masthead -->


	<?php if( is_front_page() ) : ?>
		<div class="wrap">
			<div class="site-branding--big row clearfix">
				<div class="site-logo--big s-24col m-17col"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/mdlp_logo_big.png"></a></div>
			</div><!-- .site-branding -->
		</div>
	<?php endif; ?>

  <div id="searchresults" class="search__outer"></div>

	<?php endif; ?>

	<div id="content" class="site-content clearfix">
