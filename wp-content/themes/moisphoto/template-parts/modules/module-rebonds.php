
    <section class="event__rebonds clearfix">
      <div class="wrap row">

        <div class="m-3col has-bordertop--big">
          <h3 class="h2">Autour de l'événement</h3>
        </div>
        
        <div class="m-20col m-last">
          <div class="row">

          <?php 
            if($rebonds) {

              $i = 1;

              foreach ($rebonds as $e) :

                //var_dump($e);

                $e_id = $e->ID;
                $url = get_permalink ( $e_id );
                $my_excerpt = get_the_excerpt( $e_id);

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

                endif;  ?>

                <div class="m-6col m-<?php echo $push; ?>col-push rebonds__item <?php echo $clearfix; ?>">

                  <?php echo '<h4 class="h3">'. get_the_title( $e ) . '</h4>'; ?>

                  <?php 
                    if( get_post_type( $e) == "event" ) { 
                      $type = '' ;
                      ?>

                    <?php the_field('description', $e_id); ?>
                    <?php the_field('adresse', $e_id); ?>


                  <?php } ?>


                  <?php if( get_post_type( $e) == "post" ) { ?>

                    <div class="has-bordertop--little">
                      <?php echo $my_excerpt; ?>
                    </div>

                  <?php } ?>


                  <?php if( get_post_type( $e) == "page" ) { ?>
                  
                    <div class="has-bordertop--little">
                      <?php echo $my_excerpt; ?>
                    </div>

                  <?php } ?>

                  <a href="<?php echo $url; ?>" class="a--inline">En savoir plus</a>
            
                </div>

              <?php  endforeach; 
            
            } ?>
          </div>
        </div>
        
      </div>
    </section><!-- .event__rebonds -->