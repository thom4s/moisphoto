<?php
/**
 * Template part for displaying page content in page-edition.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

$useragent = $_SERVER['HTTP_USER_AGENT'];

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


  <div class="entry-content clearfix">


      <?php
      if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) : 
      ?>


    <div class="edition__mobile row">
      <div class="is-centered s-16col">
        <p><a href="#" class="js-display-events">voir la list des expositions</a></p>
        <p><a href="/carte">voir la map en plein écran</a></p>
        <p> <a href="#">voir les exposition autour de moi</a></p>
      </div> 
    </div>

  <?php else: ?>


    <?php 
      // GET MAP ITEMS AND DISPLAY

      $type_relation = get_field('type_relation', $current_edition);      
      $events = array();
      $places = array();

      if( $type_relation == 'Weekends') : 
        $weekends = get_field('weekends',  $current_edition); // ID

        foreach ($weekends as $we) {
          $events_list = get_field('events_list', $we);
          $color_we = get_field('color', $we);
          $color_we = str_replace('#', '', $color_we); 
          
          foreach ($events_list as $e) {
            $events[] = $e;
            $places_events_array[$e] = array( get_field('lieu', $e), $color_we );
          }            
        }
        $is_weekend = true; 

      elseif ( $type_relation == 'Événements' ) :
        $events = get_field('evenements', $current_edition);

        foreach ($events as $e) {
          $places_events_array[$e] = array( get_field('lieu', $e), 'default' );
        }    
        $is_weekend = false; 

      endif; 
        $is_weekend = false; 

      set_query_var('events', $events); 
      set_query_var('places_events_array', $places_events_array); 
      set_query_var('is_weekend', $is_weekend); 

      get_template_part( 'template-parts/modules/module', 'map' ); 

      // END MAP ?>

  <?php endif; ?>

    <?php 
      // GET GRID ITEMS AND DISPLAY

      $grid_items = get_field('grid');
      set_query_var('grid_items', $grid_items); 
      get_template_part( 'template-parts/modules/module', 'grid' ); 

      // END GRID ?>


    <section class="news-group clearfix">
      <div class="wrap row">
        <?php 
          $news_main = get_field('news_main');
          $number_of_posts = 3;
          set_query_var('number_of_posts', $number_of_posts); 
          set_query_var('news_main', $news_main); 
        ?>
        <div class="m-16col">
          <?php get_template_part( 'template-parts/modules/module', 'news' ); ?>
        </div>

        <div class="m-6col m-last">
          <?php 
            $number_of_item = 4;
            set_query_var('number_of_item', $number_of_item); 
          ?>
          <?php get_template_part( 'template-parts/modules/module', 'stream' ); ?>
        </div>
      </div>  
    </section>


    <?php get_template_part( 'template-parts/modules/module', 'partners' ); ?>


  </div><!-- .entry-content -->
</article><!-- #post-## -->
