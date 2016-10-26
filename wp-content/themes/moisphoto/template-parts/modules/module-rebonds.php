
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

                $e_id = $e->ID;
                $url = get_permalink ( $e_id );
                $my_excerpt = $e->post_content;

                if ( strlen($my_excerpt) > 250 ) {
                  $my_excerpt = substr($my_excerpt, 0, '200') . '...';
                } 

                
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


                  <?php 
                    if( get_post_type( $e) == "event" ) { 
                      // Get Variables
                      $auteurs = get_field('auteurs', $e); 
                      $date_fixe = get_field('date_fixe', $e);
                      $lieu = get_field('lieu', $e);
                      $lieu_adresse_group = get_field('adresse', $lieu);
                      $lieu_adresse = $lieu_adresse_group['address'];
                      $type = get_terms( 'event-type' );

                      ?>

                    <h4 class="h3"><?php if($auteurs) { moisphoto_get_artists_list($auteurs); } ?></h4>

                    <h5 class="h5"><?php echo get_the_title( $e ); ?></h5>

                    <p class="p--strong">
                      <?php if($type) { moisphoto_get_artists_list($type); echo '<br>'; } ?>
                    <?php 
                      if($date_fixe) {
                        the_field('date'); 
                      } else {
                        the_field('date_debut');
                        echo ' - ';
                        the_field('date_fin');
                      }
                    ?>
                    </p>

                    <div class="rebonds__chapo has-bordertop--little">
                      <p class="p--strong"><?php echo get_the_title( $lieu ); ?></p>
                    </div>

                  <?php } ?>


                  <?php if( get_post_type( $e) == "post" ) { ?>
                    <?php echo '<h4 class="h3">'. get_the_title( $e ) . '</h4>'; ?>

                  <?php } ?>


                  <?php if( get_post_type( $e) == "page" ) { ?>
                    <?php echo '<h4 class="h3">'. get_the_title( $e ) . '</h4>'; ?>

                  <?php } ?>

                    <div class="rebonds__chapo has-bordertop--little">
                      <p><?php echo $my_excerpt; ?></p>
                    </div>

                  <div>
                    <span class="arrow--little--black"> > </span>
                    <a href="<?php echo $url; ?>" class="a--inline">En savoir plus</a>
            
                  </div>
                  
                </div>

              <?php  endforeach; 
            
            } ?>
          </div>
        </div>
        
      </div>
    </section><!-- .event__rebonds -->