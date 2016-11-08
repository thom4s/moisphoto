
<?php 

  if( is_object( $e ) ) {
    $e_id = $e->ID;
    $my_excerpt = $e->post_content;
  } else {
    $e_id = $e;
    $my_excerpt = get_post_field('post_content', $e);
  }

  $url = get_permalink ( $e_id );

  if ( strlen($my_excerpt) > 250 ) {
    $my_excerpt = substr($my_excerpt, 0, '200') . '...';
  } ?>

<div class="m-6col m-<?php echo $push; ?>col-push rebonds__item <?php echo $clearfix; ?>">

  <?php 
    if( get_post_type( $e_id) == "event" ) { 
      // Get Variables
      $auteurs = get_field('auteurs', $e_id); 
      $date_fixe = get_field('date_fixe', $e_id);
      $lieu = get_field('lieu', $e_id);
      $chapo = get_field('chapo', $e);
      $lieu_adresse_group = get_field('adresse', $lieu);
      $lieu_adresse = $lieu_adresse_group['address'];
      $type = get_terms( 'event-type' ); ?>

  <?php echo get_the_post_thumbnail($e_id, 'part-thumb'); ?>

  <h4 class="h3"><?php if($auteurs) { moisphoto_get_artists_list($auteurs); } ?></h4>

  <h5 class="h5"><?php echo get_the_title( $e_id ); ?></h5>

  <?php if($chapo) :?>
    <div class="modal__intro"><?php echo $chapo; ?></div>
  <?php endif; ?>

  <p class="p--strong">
    <?php if($type) { moisphoto_get_artists_list($type); echo '<br>'; } ?>
    
    <?php 
      if($date_fixe) {
        the_field('date', $e_id); 
      } else {
        the_field('date_debut', $e_id);
        echo ' - ';
        the_field('date_fin', $e_id);
      } ?>
  </p>

  <div class="rebonds__place">
    <p class="p--strong rebonds__place__name"><?php echo get_the_title( $lieu ); ?></p>

    <p class="rebonds__place__city"><?php echo $lieu_adresse; ?></p>
  </div>

  <?php } ?>


  <?php if( get_post_type( $e) == "post" ) { ?>

    <?php echo get_the_post_thumbnail($e, 'part-thumb'); ?>

    <?php echo '<h4 class="h3">'. get_the_title( $e ) . '</h4>'; ?>
    <div class="rebonds__chapo">
      <p><?php echo $my_excerpt; ?></p>
    </div>
  <?php } ?>


  <?php if( get_post_type( $e) == "page" ) { ?>
    <?php echo '<h4 class="h3">'. get_the_title( $e ) . '</h4>'; ?>
    <div class="rebonds__chapo">
      <p><?php echo $my_excerpt; ?></p>
    </div>
  <?php } ?>



  <div>
    <span class="arrow--little--black"> > </span>
    <a href="<?php echo $url; ?>" class="a--inline">En savoir plus</a>     
  </div>
                  
</div>



