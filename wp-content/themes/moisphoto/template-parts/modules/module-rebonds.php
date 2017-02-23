
    <section class="event__rebonds clearfix">
      <div class="wrap row">

        <?php if( is_singular( 'event' )) : ?>
          <div class="has-bordertop--big clearfix"></div>   
          <h3 class="h2 clearfix">Autour de l'exposition</h3>
        <?php endif; ?>

        <div class="m-20col is-centered">
          <div class="row">

          <?php 
            if($rebonds) {

              $i = 1;

              foreach ($rebonds as $e) : 

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
            
            } ?>
          </div>
        </div>
        
      </div>
    </section><!-- .event__rebonds -->