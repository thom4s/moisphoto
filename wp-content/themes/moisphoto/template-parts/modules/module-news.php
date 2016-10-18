<?php 

  // var_dump($news_main);
  // var_dump($number_of_posts);

  if( $news__main ) {
    $number_of_posts = $number_of_posts - 1;
  }

  $args = array(
    'posts_per_page'   => $number_of_posts,
    'offset'           => 0,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => $news_main->ID,
    'post_type'        => 'post',
    'post_status'      => 'publish',
  );
  $posts_array = get_posts( $args ); 

?>


<section class="module-news">
  <div class="row clearfix">

    <?php if( $news_main ): ?>
      <div class="news__main l-15col">

        <?php 
          $post = $news_main;
          setup_postdata( $post ); 
        ?>
            <div class="news__item">
              <a href="<?php the_permalink(); ?>">

                <?php if ( has_post_thumbnail() ) : ?>
                  <div class="news__item__img--big"><?php the_post_thumbnail(); ?></div>
                <?php endif; ?>
                
                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>
              </a>
            </div>
            <?php wp_reset_postdata();  ?>

      </div>
    <?php endif; ?>
  </div>


  <div class="row">
    <div class="news__list">

      <?php if( $posts_array ): ?>
        <?php foreach( $posts_array as $post): ?>
            <?php setup_postdata($post); ?>
            <div class="news__item l-7col">
              <a href="<?php the_permalink(); ?>">
                <?php if ( has_post_thumbnail() ) : ?>
                  <div class="news__item__img--little"><?php the_post_thumbnail(); ?></div>
                <?php endif; ?>

                <h3><?php the_title(); ?></h3>
                <p><?php the_excerpt(); ?></p>
              </a>
            </div>
        <?php endforeach; ?>
        <?php wp_reset_postdata();  ?>
      <?php endif; ?>

    </div>
  </div>


</section>

