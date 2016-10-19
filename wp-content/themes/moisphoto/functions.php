<?php
/**
 * moisphoto functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package moisphoto
 */

if ( ! function_exists( 'moisphoto_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function moisphoto_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on moisphoto, use a find and replace
	 * to change 'moisphoto' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'moisphoto', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Principal', 'moisphoto' ),
		'secondary' => esc_html__( 'Secondaire', 'moisphoto' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'moisphoto_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'moisphoto_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function moisphoto_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'moisphoto_content_width', 640 );
}
add_action( 'after_setup_theme', 'moisphoto_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function moisphoto_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'moisphoto' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'moisphoto' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'moisphoto_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function moisphoto_scripts() {
	wp_enqueue_style( 'moisphoto-style', get_stylesheet_uri() );

	wp_deregister_script('jquery');
	wp_register_script('jquery', 'http://code.jquery.com/jquery-2.1.4.min.js', false, '2.1.4', false);
	wp_enqueue_script('jquery');


  wp_enqueue_script( 'mdlp-scripts', get_stylesheet_directory_uri() . '/js/all.min.js', array( 'jquery' ), '1.0', true );


}
add_action( 'wp_enqueue_scripts', 'moisphoto_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';




/**
 * Custom language menu
 */
function icl_post_languages(){
  $languages = icl_get_languages('skip_missing=1&orderby=name&order=desc');
  if(1 < count($languages)){
    foreach($languages as $l){
	    if(!$l['active']) $langs[] = '<a href="'.$l['url'].'">'.$l['language_code'].'</a>';
    }
    echo join('', $langs);
  }
}
add_action( 'display_languages', 'icl_post_languages', 10, 2 );





/**
 * Load Ajax
 */

add_action( 'wp_enqueue_scripts', 'ajax_enqueues' );
function ajax_enqueues() {
    if (!is_admin()) {
      wp_enqueue_script( 'ajax-scripts', get_stylesheet_directory_uri() . '/js/assets/ajax-scripts.js', array( 'jquery' ), '1.0.0', true );
      wp_localize_script( 'ajax-scripts', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
    }
}


/**
 * Special Ajax Search
 */

add_action( 'wp_ajax_load_search_results', 'load_search_results' );
add_action( 'wp_ajax_nopriv_load_search_results', 'load_search_results' );
function load_search_results() {
    $query = $_POST['query'];

    $args = array(
        'post_type' => array('post', 'event', 'page'),
        'post_status' => 'publish',
        's' => $query
    );
    $search = new WP_Query( $args );

    ob_start();

    ?>

      <div class="search-container wrap row">

        <div id="loading-msg" class="loading-msg">Nous cherchons des réponses...</div>


          <header class="search-header">
            <h3 class="h2 search-title">Résultat de la recherche</h3>
          </header>

          <div class="search-results">
              <div class="results-number">
                <?php if( $search->post_count > 0) : ?>
                  <?php echo $search->post_count; ?> pages trouvées :
                <?php endif; ?>
              </div>

              <?php if ( $search->have_posts() ) : ?>

              <ul class="results-list">
                <?php while ( $search->have_posts() ) : $search->the_post(); ?>

                <li class="result-item">
                  <a href="<?php the_permalink(); ?>">
                  
                    <?php the_title(); ?>  - 

                    <span>
                    <?php 
                    $post_type = get_post_type( get_the_ID() );

                    switch ($post_type) {
                      case 'page':
                        echo 'page d\'informations';
                        break;

                      case 'post':
                        $cats = '';
                        $categories = get_the_category( get_the_ID()  ); 
                        foreach( $categories as $category ) { $cats .= $category->name; } 

                        echo 'Actualité - ';
                        echo $cats;
                        echo ' - ';
                        echo get_the_time( 'j.d.Y', get_the_ID() );

                        break;

                      case 'event':
                        echo 'Evénement - ';
                        the_field('date');
                        echo ' - '; 
                        the_field('lieu'); 
                        break;

                      default:
                        # code...
                        break;
                    }
                    
                    ?>
                    </span>

                  </a>
                </li>
                <?php endwhile; ?>

              </ul>

              <?php wp_reset_postdata(); ?>

            <?php else : ?>
              <p class="no-result"><?php _e( 'Désolé, il n\'y a aucun résultat pour votre recherche.' ); ?></p>
            <?php endif; ?>

            <a href="#" id="close-search" class="clearfix close-search">(Fermer la recherche)</a>

          </div>
        </div>

  <?php

  $content = ob_get_clean();

  echo $content;
  die();
}





/**
 * Press_search Ajax
 */

add_action( 'wp_ajax_press_search', 'load_press_search' );
add_action( 'wp_ajax_nopriv_press_search', 'load_press_search' );
function load_press_search() {
    $query = $_POST['query'];

    $args = array(
        'post_type' => array('event'),
        'post_status' => 'publish',
        's' => $query
    );
    $search = new WP_Query( $args );

    ob_start();

    ?>

      <div class="search-container wrap row">

        <div id="loading-msg" class="loading-msg">Nous cherchons des réponses...</div>

          <div class="search-results">
              <div class="results-number">
                <?php if( $search->post_count > 0) : ?>
                  <?php echo $search->post_count; ?> événements ont été trouvés :
                <?php endif; ?>
              </div>

              <?php if ( $search->have_posts() ) : ?>

                <?php while ( $search->have_posts() ) : $search->the_post(); 

                    $auteurs = get_field('auteurs'); 
                    $lieu = get_field('lieu');
                    $id = $post->ID; ?>

                  <div class="press__list__item">
                    <p><?php moisphoto_get_artists_list($auteurs); ?> - <?php the_title(); ?></p>

                    <p><?php echo get_the_title( $lieu ); ?></p>

                    <div class="press__btn">
                      <a href="<?php the_permalink(); ?>?pdf=" classe="" target="_blank">pdf</a>
                      <a href="?zip=<?php echo $id; ?>" classe="">zip</a>
                    </div>

                  </div>

                <?php endwhile; ?>


              <?php wp_reset_postdata(); ?>

            <?php else : ?>
              <p class="no-result"><?php _e( 'Désolé, il n\'y a aucun résultat pour votre recherche.' ); ?></p>
            <?php endif; ?>


          </div>
        </div>

  <?php

  $content = ob_get_clean();

  echo $content;
  die();

}




/**
 * Special Ajax Display Events
 */

add_action( 'wp_ajax_nopriv_ajax_pagination', 'my_ajax_pagination' );
add_action( 'wp_ajax_ajax_pagination', 'my_ajax_pagination' );

function my_ajax_pagination() {

   $args = array(
        'post_type' => array('event'),
        'post_status' => 'publish',
    );
    $events = new WP_Query( $args );

    ob_start();

    ?> 

      <div class="events-container wrap row">

        <div id="loading-msg" class="loading-msg">Nous cherchons des réponses...</div>

          <header class="events-header">
            <h3 class="h2 events-title">Résultat de la recherche</h3>
          </header>

          <div class="events-results">
              <div class="results-number">
                <?php if( $events->post_count > 0) : ?>
                  <?php echo $events->post_count; ?> pages trouvées :
                <?php endif; ?>
              </div>

              <?php if ( $events->have_posts() ) : ?>

              <ul class="results-list">
                <?php while ( $events->have_posts() ) : $events->the_post(); ?>

                <li class="result-item">
                  <a href="<?php the_permalink(); ?>">
                  
                    <?php the_title(); ?>

                  </a>
                </li>
                <?php endwhile; ?>

              </ul>

              <?php wp_reset_postdata(); ?>

            <?php else : ?>
              <p class="no-result"><?php _e( 'Désolé, il n\'y a aucun résultat pour votre recherche.' ); ?></p>
            <?php endif; ?>

            <a href="#" id="close-events" class="clearfix close-events">(Fermer la fenetre)</a>

          </div>
        </div>

  <?php

  $content = ob_get_clean();

  echo $content;
  die();


}



