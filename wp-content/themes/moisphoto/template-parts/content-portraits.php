<?php
/**
 * Template part for displaying page content in page-edition.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

?>

<article id="post-<?php the_ID(); ?>" class="portraits">

  <div class="entry-content clearfix">


    <header class="page__header clearfix">
      <div class="wrap row">
        
        <div class="has-bordertop--big clearfix"></div>

        <div class="entry__header text-on-left">
          <h1><?php the_title(); ?></h1>
        </div>
      
        <div class="m-14col entry__content">
          <?php the_content(); ?>
        </div>
      
        <div class="thumbnail m-8col m-last">
          <?php the_post_thumbnail(''); ?>
        </div>
      </div>
    </header>


    <section class="module-partners clearfix">
      <div class="wrap row">  

        <div class="has-bordertop--big clearfix"></div>   
        <h3 class="h2 clearfix"> Les partenaires des Grands Parisiens</h3>

        <?php the_field('partenaires'); ?>
      
      </div>
    </section>



  </div><!-- .entry-content -->
</article><!-- #post-## -->
