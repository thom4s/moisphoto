
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