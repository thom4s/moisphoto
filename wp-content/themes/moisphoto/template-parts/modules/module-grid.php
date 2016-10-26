
<section class="module-grid clearfix">
  <div class="wrap">

    <?php

    $i = 1;

    foreach ($grid_items as $item) {

      $type_item =  $item['acf_fc_layout'];

      if($i % 2 == 0) : 
        $order_item = 'even';

      else : 
        echo '<div class="grid__row clearfix row">';
        $order_item = 'odd';

      endif; 

      switch ( $item['acf_fc_layout'] ) {
        case 'btn_show_events': ?>
          <a href="#" class="js-display-events">
            <div class="grid__item--btn l-6col <?php echo $order_item; ?> square">
              <div class="square__content">
                <?php echo $item['btn_chapo']; ?>
              </div>
            </div>
          </a>
          <?php break;

        case 'affiche': ?>
          <div class="grid__item--affiche l-6col <?php echo $order_item; ?>">
            <img src="<?php echo $item['file']['url']; ?>">
          </div>
          <?php break;


        case 'text': ?>
          <a href="<?php echo $item['text_link']; ?>">
            <div class="grid__item--text l-6col <?php echo $order_item; ?> square">
              <div class="square__content">
                <h3 class="h3"><?php echo $item['text_title']; ?></h3>
                <div class="has-bordertop--little"> <?php echo $item['text_intro']; ?></div>
                
                <div>
                  <span class="arrow--little--black"> > </span>
                  <span class="a--inline">En savoir plus</span>
                </div>  

              </div>
            </div>
          </a>
          <?php
          break;


        case 'weekend': ?>
          <?php 
            $we_id = $item['weekend_item'];
            $we_url = get_permalink ( $we_id ); 
            $we_color = get_field('color', $we_id);
          ?>
          <a href="<?php echo $we_url; ?>">
            <div class="grid__item--weekend l-14col <?php echo $order_item; ?>" style="border-color:<?php echo $we_color; ?>">
              <div class="row">
              
                <div class="l-8col">
                  <div class="square__content grid__item__img">
                    <div class="table">
                      <img src="<?php echo $item['weekend_img']; ?>">
                      <div class="arrow--medium--black" style="background-color:<?php echo $we_color; ?>"> > </div>
                    </div>
                  </div>
                </div>
              
                <div class="l-6col square">
                  <div class="square__content">
                    <h3 class="h3"><?php echo $item['weekend_title']; ?></h3>
                    <div class="has-bordertop--little"> <?php echo $item['weekend_intro']; ?></div>

                    <div>
                      <a class="a--inline">...</a>
                    </div> 
                  
                  </div>
                </div>
              
              </div>
            </div>
          </a>
          <?php
          break;


        case 'big_bloc': ?>
          <a href="<?php echo $url; ?>">
            <div class="grid__item--big l-15col <?php echo $order_item; ?>">
              <div class="row">
              
                <div class="l-9col square">
                  <div class="square__content grid__item__img">
                      <img src="<?php echo $item['big_bloc_img']; ?>">
                      <div class="arrow--medium--white"> > </div>
                  </div>
                </div>
              
                <div class="l-6col square">
                  <div class="square__content">
                    <h3 class="h3"><?php echo $item['big_bloc_title']; ?></h3>
                    <div class="has-bordertop--little"> <?php echo $item['big_bloc_text']; ?></div>
                  </div>
                </div>
              
              </div>
            </div>
          </a>
          <?php
          break;


        case 'page': ?>
          <?php 
            $page_id = $item['post_item'];
            $url = get_permalink ( $item['page_item'] );
            $post_title = get_the_title( $page_id ) ?>
          <a href="<?php echo $url; ?>">
            <div class="grid__item--page l-6col <?php echo $order_item; ?> square">
              <div class="square__content">
                
                <h3 class="h3">
                  <?php if ( $item['page_title'] == '' ) {
                    echo get_the_title( $item['page_item'] );
                  }  else {
                    echo $item['page_title']; 
                  } ?>
                </h3>
                
                <div class="has-bordertop--little"> <?php echo $item['page_intro']; ?></div>

                <div>
                  <span class="arrow--little--black"> > </span>
                  <span class="a--inline">Lire la suite</span>
                </div>  

              </div>
            </div>
          </a>
          <?php
          break;


        case 'post': ?>
          <?php
            $post_id = $item['post_item'][0]->ID;
            $url = get_permalink ( $post_id );
            $post_title = get_the_title( $post_id ); ?>
            
          <a href="<?php echo $url; ?>">
            <div class="grid__item--post l-6col <?php echo $order_item; ?> square">
              <div class="square__content">
                
                <h3 class="h3"><?php echo $post_title; ?></h3>
                
                <div class="has-bordertop--little"> <?php echo $item['post_intro']; ?></div>

                <div>
                  <span class="arrow--little--black"> > </span>
                  <span class="a--inline">Lire la suite</span>
                </div>  

              </div>
            </div>
          </a>
          <?php
          break;

        default:
          break;
      }

      if($i % 2 == 0) : 
        echo '</div><!-- .row -->';

      endif; 
      $i++;
    }

    ?>



  </div>
</section><!-- .section.grid -->


