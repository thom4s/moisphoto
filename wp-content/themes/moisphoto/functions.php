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

  wp_register_script('social-stream', get_stylesheet_directory_uri() . '/js/assets/jquery.social.stream.1.6.min.js', array( 'jquery' ), '1.6', true);
  wp_register_script('social-wall', get_stylesheet_directory_uri() . '/js/assets/jquery.social.stream.wall.1.7.js', array( 'jquery', 'social-stream' ), '1.7', true);

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
                    $id = get_the_ID(); ?>

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

  $nearby = $_POST['nearby'];
  $event_latitude = $_POST['event_latitude'];
  $event_longitude = $_POST['event_longitude'];

  $event_latitude = '48.8652352';
  $event_longitude = '2.3634082999999464';



  $lat = maybe_serialize( array("lat" => $event_latitude) ); // a:1:{s:3:"bar";s:6:"foobar";}
  $lat = rtrim( ltrim( $lat, 'a:1:{' ), '}' );    // on élague les bords qui nous gênent : s:3:"bar";s:6:"foobar";

  $lng = maybe_serialize( array("lng" => $event_longitude) ); // a:1:{s:3:"bar";s:6:"foobar";}
  $lng = rtrim( ltrim( $lng, 'a:1:{' ), '}' );    // on élague les bords qui nous gênent : s:3:"bar";s:6:"foobar";

  if( $nearby ) :

    $meta_query[] = array(
      'key'   => 'adresse',
      'value'   => $lat,
      'compare' => 'LIKE',
    );

    $nearby_places_args = array(
        'posts_per_page'   => -1,
        'meta_query'       => $meta_query,
        'post_type'        => 'place',
        'post_status'      => 'publish',
        'suppress_filters' => 0 
      );
    $nearby_places_array = get_posts($nearby_places_args);

    // var_dump($nearby_places_array);

      // lieux proches
      $meta_query[] = array(
         'key'   => $name,
                'value'   => $value,
                'compare' => 'IN',
            );

      $args = array(
        'posts_per_page'   => 5,
        'category'         => 'exposition',
        'orderby'          => 'date',
        'order'            => 'DESC',
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'event',
        'post_status'      => 'publish',
        'suppress_filters' => 0 
      );
      $events_array = get_posts($args);

//    var_dump($events_array);


  else : 

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

  endif; // endif nearby or not

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



/**
 * Check if mobile device
 * @return true if mobile
 **/
function is_mobile() {
  $useragent = $_SERVER['HTTP_USER_AGENT'];

  if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) : 

    return true;
  
  else : 
    return false;
  
  endif;
}


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

