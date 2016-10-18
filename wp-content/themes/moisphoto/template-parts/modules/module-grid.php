
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

          <div class="grid__item--btn l-6col <?php echo $order_item; ?> square">
            <div class="square__content">
              <?php echo $item['btn_chapo']; ?>
            </div>
          </div>

          <?php break;


        case 'text': ?>

          <div class="grid__item--text l-6col <?php echo $order_item; ?> square">
            <div class="square__content">
              <?php echo $item['text_title']; ?>
              <?php echo $item['text_intro']; ?>
              <?php echo $item['text_link']; ?>
            </div>
          </div>

          <?php
          break;

        case 'weekend': ?>

          <div class="grid__item--weekend l-14col <?php echo $order_item; ?>">
            <div class="row">
            
              <div class="l-8col square">
                <div class="square__content">
                  <?php echo $item['weekend_item']; ?>
                </div>
              </div>
            
              <div class="l-6col square">
                <div class="square__content">
                  <?php echo $item['weekend_title']; ?>
                  <?php echo $item['weekend_intro']; ?>
                </div>
              </div>
            
            </div>
          </div>

          <?php
          break;

        case 'page': ?>

          <div class="grid__item--page l-6col <?php echo $order_item; ?> square">
            <div class="square__content">
              <?php echo $item['page_item']; ?>
              <?php echo $item['page_title']; ?>
              <?php echo $item['page_intro']; ?>
            </div>
          </div>

          <?php
          break;

        case 'post': ?>

          <div class="grid__item--post l-6col <?php echo $order_item; ?> square">
            <div class="square__content">
              <?php echo $item['post_item']; ?>
              <?php echo $item['post_title']; ?>
              <?php echo $item['post_intro']; ?>
            </div>
          </div>

          <?php
          break;

        default:
          break;
      }

      if($i % 2 == 0) : 
        echo '</div><!-- .row -->';
        
      else : 

      endif; 

      $i++;
    }

    ?>



  </div>
</section><!-- .section.grid -->


