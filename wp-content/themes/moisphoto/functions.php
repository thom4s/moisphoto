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
 * Ajax main Search 
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
        <a href="#" id="close-search" class="clearfix close-events"></a>

        <div id="loading-msg" class="loading-msg globalsearch-msg">
          <div class="table">
            <div class="table-cell"><p class="p--big">... Nous cherchons des réponses...</p></div>
          </div>
        </div>

        <div class="search__results">
          <div class="results-number">
            <?php if( $search->post_count > 0) : ?>
              <h5 class="h3">Nous avons <?php echo $search->post_count; ?> résultats à votre recherche :</h5>
            <?php endif; ?>
          </div>

          <?php if ( $search->have_posts() ) : ?>

          <ul class="search__list no-bullets">
            <?php while ( $search->have_posts() ) : $search->the_post(); ?>

              <li class="search__item has-bordertop--little">
                <a href="<?php the_permalink(); ?>">
                  
                    <?php 
                    $post_type = get_post_type( get_the_ID() );

                    switch ($post_type) {
                      case 'page':
                        echo '<span class="p--big">';
                        the_title();  
                        echo '</span>';
                        echo ' | page d\'informations';
                        break;

                      case 'post':
                        $cats = '';
                        $categories = get_the_category( get_the_ID()  ); 
                        foreach( $categories as $category ) { $cats .= $category->name; } 

                        echo '<span class="p--big">';
                        the_title();  
                        echo '</span>';

                        echo ' | Actualité - ';
                        echo $cats;
                        echo ' - ';
                        echo get_the_time( 'j.d.Y', get_the_ID() );

                        break;

                      case 'event': 
                        $auteurs = get_field('auteurs'); 
                        $lieu = get_field('lieu'); ?>
                        <p><span class="p--big"><?php moisphoto_get_artists_list($auteurs); ?></span> 
                          <span class="p--strong">- <?php the_title(); ?></span>
                          <span class=""> | <?php echo get_the_title( $lieu ); ?></span>
                        </p>

                        <?php break;

                      default:
                        # code...
                        break;
                    }
                    
                    ?>

                  </a>
                </li>
                <?php endwhile; ?>

              </ul>

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

      <div class="search__container wrap row">

          <div id="loading-msg" class="loading-msg presssearch-msg">
            <div class="table">
              <div class="table-cell"><p class="p--big">... Nous cherchons des réponses...</p></div>
            </div>
          </div>

          <div class="search__results">
              <div class="results-number">
                <?php if( $search->post_count > 0) : ?>
                  <h4 class="h3"> <?php echo $search->post_count; ?> événements ont été trouvés :</h4>
                <?php endif; ?>
              </div>

              <?php if ( $search->have_posts() ) : ?>

                <?php while ( $search->have_posts() ) : $search->the_post(); 

                    $auteurs = get_field('auteurs'); 
                    $lieu = get_field('lieu');
                    $id = $post->ID; ?>

                    <div class="press__list__item">
                      <p><span class="p--big"><?php moisphoto_get_artists_list($auteurs); ?></span> 
                        <span class="p--strong">- <?php the_title(); ?></span>
                        <span class=""> | <?php echo get_the_title( $lieu ); ?></span>
                      </p>
                      <p class="press__btn">
                        <span class="p--strong">Téléchargez :  </span>
                        <a href="<?php the_permalink(); ?>?pdf=" classe="" target="_blank">le DP (.pdf)</a>
                        - <a href="?zip=<?php echo $id; ?>" classe="">Les visuels (zip)</a>
                      </p>
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

add_action( 'wp_ajax_nopriv_load_events', 'load_events_list' );
add_action( 'wp_ajax_load_events', 'load_events_list' );

function load_events_list() {


  // GET MAP ITEMS AND DISPLAY

  $front_page_id = get_option('page_on_front');
  $current_edition = get_field('edition_courante', $front_page_id); 
  $type_relation = get_field('type_relation', $current_edition);
  $events_array = array();
  $places_array = array();

  if( $type_relation == 'Weekends') : 
    $weekends = get_field('weekends',  $current_edition); // ID

    foreach ($weekends as $we) {
      $events_list = get_field('events_list', $we);
      $color_we = get_field('color', $we);
      $color_we = str_replace('#', '', $color_we); 
                      
      foreach ($events_list as $e) {
        $events_array[] = $e;
        $places_events_array[$e] = array( get_field('lieu', $e), $color_we );
      }            
    }
    $is_weekend = true; 

  elseif ( $type_relation == 'Événements' ) :
    $events_array = get_field('evenements', $current_edition);

    foreach ($events_array as $e) {
      $places_events_array[$e] = array( get_field('lieu', $e), 'default' );
    }    
    $is_weekend = false; 

  endif; 
  
  $is_weekend = false; 

  ob_start(); ?> 

      <div class="events-container row">
        <div id="loading-msg" class="loading-msg">Nous cherchons des réponses...</div>

        <div class="event__rebonds clearfix">

          <div class="wrap">
            <?php 
              if($events_array) :

                $i = 1;

                foreach ($events_array as $e) : 

                  $clearfix = ''; 

                  if( $i%3 == 0 ) : 
                    $push = '2';
                    $i = 1;

                  elseif( $i%2 == 0 ) : 
                    $push = '1';
                    $i++;

                  else : 
                    $push = '0';
                    $clearfix = 'clearfix';
                    $i++;

                  endif;  

                  set_query_var('e', $e); 
                  set_query_var('push', $push); 
                  set_query_var('clearfix', $clearfix); 
                  get_template_part('template-parts/parts/part', 'item'); ?>

                <?php  endforeach; 
              
              else : ?>
              <p class="no-result"><?php _e( 'Désolé, il n\'y a aucun résultat pour votre recherche.' ); ?></p>
            <?php endif; ?>
          </div>

        </div>
      </div>

  <?php

  $content = ob_get_clean();

  echo $content;
  die();
}



function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


/**
 * Filtre sur le shortcode  pour un code "HTML5 Compliant"
 * @return text HTML décrivant un contenu de type image
 **/
if ( !function_exists('juiz_img_caption_shortcode_html5_compliant')) {
  function juiz_img_caption_shortcode_html5_compliant($val, $attr, $content = null)
  {
    extract(shortcode_atts(array(
      'id'  => '',
      'align' => '',
      'width' => '',
      'caption' => ''
    ), $attr));

    if ( empty ($caption) || 1 > (int)$width )
      return $val;

    $capid = '';
    if ( $id ) {
      $id = esc_attr($id);
      $id = str_replace('attachment_', '', $id);
      $caption = get_field('legende', $id);

      $capid = 'id="figcaption_'. $id . '" ';
      $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
    }

    return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: '
    . (10 + (int) $width) . 'px">' . do_shortcode( $content ) . '</figure><figcaption ' . $capid 
    . 'class="wp-caption-text">' . $caption . '</figcaption>';
  }
} //endif !function_exists
add_filter('img_caption_shortcode', 'juiz_img_caption_shortcode_html5_compliant',10,3);




/**
 * Template tags for password form
 * @return html
 **/
function my_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="passwdform" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    ' . __( "<p class='passwdform-msg'>Pour accéder au contenu de cette page, merci de renseigner la mot de passe ici : </p>" ) . '
    <label for="' . $label . '">' . __( "" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( "ok" ) . '" />
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );

