<?php
/**
 * moisphoto functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package moisphoto
 */


define("FACEBOOK_LINK", 'https://www.facebook.com/moisdelaphotograndparis/');
define("TWITTER_LINK", 'https://www.twitter.com/moisdelaphotograndparis/');
define("INSTAGRAM_LINK", 'https://www.instagram.com/moisdelaphotograndparis/');



/**
 * Calculates the great-circle distance between two points, with
 * the Vincenty formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 */
function vincentyGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $lonDelta = $lonTo - $lonFrom;
  $a = pow(cos($latTo) * sin($lonDelta), 2) +
    pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
  $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

  $angle = atan2(sqrt($a), $b);
  return round($angle * $earthRadius, 2) . ' mètres';
}



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
  add_image_size( 'part-thumb', 350 ); 
  add_image_size( 'grid-thumb', 500 ); 
  add_image_size( 'news-main', 900, 450 ); 
  add_image_size( 'event-main', 900, 900 ); 

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
 * Enqueue scripts and styles.
 */
function moisphoto_scripts() {
	wp_enqueue_style( 'moisphoto-style', get_stylesheet_uri() );
  define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS',true);

  wp_deregister_script( 'wp-embed' );
	wp_deregister_script('jquery');
	wp_register_script('jquery', 'http://code.jquery.com/jquery-2.1.4.min.js', false, '2.1.4', false);
	wp_enqueue_script('jquery');

  // wp_register_script('social-stream', get_stylesheet_directory_uri() . '/js/assets/jquery.social.stream.1.6.min.js', array( 'jquery' ), '1.6', true);
  // wp_register_script('social-wall', get_stylesheet_directory_uri() . '/js/assets/jquery.social.stream.wall.1.7.js', array( 'jquery', 'social-stream' ), '1.7', true);

  wp_register_script('bxslider', get_stylesheet_directory_uri() . '/js/assets/jquery.bxslider.min.js', array( 'jquery' ), '1.6', true);

  wp_enqueue_script( 'mdlp-scripts', get_stylesheet_directory_uri() . '/js/all.min.js', array( 'jquery' ), '1.0', true );

  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );

  wp_dequeue_style('cff-style');

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
              <h5 class="h3">Nous avons <?php echo $search->post_count; ?> résultat<?php if($search->post_count !== 1) { echo 's'; } ?> à votre recherche :</h5>
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

              <?php if ( $search->have_posts() ) :

                $page_presse = get_page_by_title( 'Espace Presse' );
                $dp_pdf = get_field('dp_pdf', $page_presse->ID);
                $visuels_zip = get_field('visuels_zip', $page_presse->ID); 

                while ( $search->have_posts() ) : $search->the_post(); 

                    $auteurs = get_field('auteurs'); 
                    $lieu = get_field('lieu');
                    $id = get_the_ID();
                    ?>


                    <div class="press__list__item">
                      <p><span class="p--big"><?php moisphoto_get_artists_list($auteurs); ?></span> 
                        <span class="p--strong">- <?php the_title(); ?></span>
                        <span class=""> | <?php echo get_the_title( $lieu ); ?></span>
                      </p>
                      <?php if( $dp_pdf || $visuels_zip ) : ?>
                      <p class="press__btn">
                        <span class="p--strong">Téléchargez :  </span>
                        <?php if( $dp_pdf ) : ?>
                          <a href="<?php the_permalink(); ?>?pdf=" classe="" target="_blank">le DP (.pdf)</a> -  
                        <?php endif; ?> 
                        <?php if( $visuels_zip ) : ?>
                          <a href="?zip=<?php echo $id; ?>" classe="">Les visuels (zip)</a>
                        <?php endif; ?>
                      </p>
                    <?php endif; ?> 
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

  $nearby = $_POST['nearby'];

  if( $nearby ) :

    $my_latitude = $_POST['my_latitude'];
    $my_longitude = $_POST['my_longitude'];

    // Calcul the range of lat, lng 
    $rad = 10; // radius of bounding circle in kilometers
    $R = 6371;  // earth's mean radius, km

    $maxLat = $my_latitude + rad2deg( $rad/$R );
    $minLat = $my_latitude - rad2deg( $rad/$R );
    $maxLng = $my_longitude + rad2deg(asin( $rad/$R ) / cos(deg2rad( $lat )));
    $minLng = $my_longitude - rad2deg(asin( $rad/$R ) / cos(deg2rad( $lat )));  

    $places_meta_query[] = array(
      'relation' => 'AND', 
      array(
        'key'     => 'lat',
        'value'   => array($minLat, $maxLat),
        'compare' => 'BETWEEN'
      ),
      array(
        'key'     => 'lng',
        'value'   => array($minLng, $maxLng),
        'compare' => 'BETWEEN'
      )
    );

    $nearby_places_args = array(
        'posts_per_page'   => -1,
        'meta_query'       => $places_meta_query,
        'post_type'        => 'place',
        'post_status'      => 'publish',
        'suppress_filters' => 0 
      );
    $nearby_places_array = get_posts($nearby_places_args);

    foreach ( $nearby_places_array as $p ) {
       $places[] += $p->ID;
    }

    // Get event with nearby place
    $events_meta_query[] = array(
      array(
        'key'     => 'lieu',
        'value'   => $places,
        'compare' => 'IN'
      )
    );
    $args = array(
      'posts_per_page'    => -1,
      'category'          => 'exposition',
      'orderby'           => 'date',
      'order'             => 'DESC',
      'post_type'         => 'event',
      'post_status'       => 'publish',
      'suppress_filters'  => 0 ,
      'meta_query'        => $events_meta_query,
    );
    $events_array = get_posts($args);

    set_query_var('my_latitude', $my_latitude);
    set_query_var('my_longitude', $my_longitude);


  else : 

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

  endif; // endif nearby or not

    ob_start(); ?> 

        <div class="events-container row">
          
          <div class="event__rebonds clearfix">

            <div class="wrap">
              <?php 
                if($events_array) :

                  $i = 1;

                  foreach ($events_array as $e) : 

                    $clearfix = ''; 

                    if( !is_mobile() ) : 
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


                    else :
                      if( $i%2 == 0 ) : 
                        $push = '1';
                        $i++;

                      else : 
                        $push = '0';
                        $clearfix = 'clearfix';
                        $i++;

                      endif;

                    endif;

                    set_query_var('e', $e); 
                    set_query_var('push', $push); 
                    set_query_var('clearfix', $clearfix); 
                    get_template_part('template-parts/parts/part', 'item'); ?>

                  <?php  endforeach; 
                
                else : ?>
                <p class="position-msg"><?php _e( 'Désolé, il n\'y a aucun événement correspant à votre recherche.' ); ?></p>
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
    <label for="' . $label . '">' . __( "" ) . ' </label><input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" placeholder="entrer ici le mot de passe" /><input type="submit" name="Submit" value="' . esc_attr__( "ok" ) . '" />
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'my_password_form' );



/**
 * serialize une array pour les meta_query
 * @return 
 **/
if ( !function_exists('serialize_array_content') ):
function serialize_array_content( $array, $value_only = false ) {
  $array = serialize( (array) $array );
  $pos   = $value_only ? ';' : '{';
  return substr($array, strpos($array, $pos)+1, -1);
}
endif;



/**
 * Remove title prefix on protected posts
 * @return title
 **/
add_filter( 'private_title_format', 'yourprefix_private_title_format' );
add_filter( 'protected_title_format', 'yourprefix_private_title_format' );
 
function yourprefix_private_title_format( $format ) {
    return '%s';
}



/**
 * Save post metadata when a post is saved.
 *
 * @param int $post_id The post ID.
 * @param post $post The post object.
 * @param bool $update Whether this is an existing post being updated or not.
 */
function save_place_lat_lng( $post_id, $post, $update ) {

    $post_type = get_post_type($post_id);

    // If this isn't a 'book' post, don't update it.
    if ( "place" != $post_type ) return;

    $lieu_adresse_group = get_field('adresse', $post_id);

    // Use get_post_meta cause get_filed() return false on prod (~)
    $lieu_adresse_group = get_post_meta($post_id, 'adresse')[0];

    $lat = (float)$lieu_adresse_group['lat'];
    $lng = (float)$lieu_adresse_group['lng'];

    // Update the post's acf fields.
    update_field('lat', $lat);
    update_field('lng', $lng);

}
add_action( 'save_post', 'save_place_lat_lng', 10, 3 );




