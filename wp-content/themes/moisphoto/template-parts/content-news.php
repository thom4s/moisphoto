<?php
/**
 * Template part for displaying page content in page-news.php.
 *
 * @package moisphoto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


    <section class="news-group clearfix">
      <div class="wrap row">
        <?php 
          $number_of_posts = 12;
          set_query_var('number_of_posts', $number_of_posts); 
        ?>
        <div class="l-16col">
          <?php get_template_part( 'template-parts/modules/module', 'news' ); ?>
        </div>

        <div class="l-6col l-last">
          <?php 
            $number_of_item = 6;
            set_query_var('number_of_item', $number_of_item); 
          ?>
          <?php get_template_part( 'template-parts/modules/module', 'stream' ); ?>
        </div>
      </div>  
    </section>


</article><!-- #post-## -->
