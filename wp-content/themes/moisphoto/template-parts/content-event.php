<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

	// Get Variables
	$auteurs = get_field('auteurs'); 
	$sous_titres = get_field('sous_titres'); 
 	$date_fixe = get_field('date_fixe');
	$curiosites_liste = get_field('curiosites_liste');
	$evenements_lies = get_field('evenements_lies');  
	$lieu = get_field('lieu');
	$lieu_adresse_group = get_field('adresse', $lieu);
	$lieu_adresse = $lieu_adresse_group['address'];
	$position = array(
		'lat' => $lieu_adresse_group['lat'],
		'lng' => $lieu_adresse_group['lng'],
	);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


		<section id="summary" class="clearfix event__summary">
			<div class="wrap row">

				<div class="clearfix event__id">
					<div class="m-10col event__id__titles"><span class="id__artist"><?php moisphoto_get_artists_list($auteurs); ?></span> - <span class="id__title"> <?php the_title(); ?></span></div> 
					<div class="m-10col m-last event__id__place">
						<span class="id__place"> <?php echo get_the_title( $lieu ); ?></span> | 	
								<span class="id__date"> <?php 
									if($date_fixe) {
										the_field('date'); 
									} else {
										the_field('date_debut');
										echo ' - ';
										the_field('date_fin');
									}
								?> </span></div>
				</div>

				<ul id="summary-inner" class="clearfix no-bullets">
					<li class="arrow--little--white"> > </li>
				</ul>	
			</div>
		</section>



		<header class="event__header clearfix bg--img">
			<div class="event__header__inner">
				<div class="row wrap">
					<div class="m-8col">

						<div class="header__titles">
							<h1 class="h1"><?php moisphoto_get_artists_list($auteurs); ?></h1>
							<h2 class="h2"><?php the_title(); ?></h2>					
							<h5 class="h5"><?php 
								if($sous_titres) {
									foreach ($sous_titres as $st) {
										echo $st['sous-titre'];
									}
								}
							?></h5>
						</div>

						<div class="has-bordertop--little">
							<div class="h4"><?php echo get_the_title( $lieu ); ?></div>
							<p class="h5"><?php echo $lieu_adresse; ?></p>
						</div>

						<div class="has-bordertop--little">
							<div class="h4">
								<?php 
									if($date_fixe) {
										the_field('date'); 
									} else {
										the_field('date_debut');
										echo ' - ';
										the_field('date_fin');
									}
								?>
							</div>
						</div>

					</div>
				</div>
			</div>
		</header>
	
	<div class="event__content clearfix">

		<div class="event__curators clearfix">
			<div class="wrap row">
				<div class="h5">Commissariat : <?php the_field('nom_commissaire'); ?></div>

			</div>
		</div>	

		<div class="event__main clearfix">
			<div class="wrap row">

				<div class="m-16col">
					<div class="part" id="presentation" title="Présentation"></div>

<!-- 					<?php if( get_field('chapo') != '' ) : ?>
						<div class="p--big event__extract">
							<?php the_field('chapo'); ?>
						</div>
					<?php endif; ?> -->

          <?php 
          	if ( has_post_thumbnail() ) : 
          		$media_id = get_post_thumbnail_id();
           		$caption = get_field('legende', $media_id);
					?>
            <div class="clearfix event__thumbnail">

							<figure class="event__thumbnail wp-caption"><?php the_post_thumbnail('event-main'); ?></figure>
							<figcaption class="wp-caption-text"><?php echo $caption; ?></figcaption>

	          </div>
          <?php endif; ?>

					<div class="event__text row">
						<?php	the_content(); ?>
					</div>
					
					<div><?php the_field('catalogue'); ?></div>

				</div>
				

				<div class="m-6col m-last">

					<div class="event__dates">
						<div class="h4">
							<?php 
								if($date_fixe) {
									the_field('date'); 
								} else {
									the_field('date_debut');
									echo ' - ';
									the_field('date_fin');
								}
							?>
						</div>
					</div>


					<div class="event__place">
						<div class="part" id="lieu" title="Le lieu"></div>

						<h3 class="h3">Informations pratiques</h3>

						<h5 class="p--big has-bordertop--little">
							<?php echo get_the_title( $lieu ); ?><br>
							<span class="p"><?php $type_lieu = get_field('type_de_lieu', $lieu); //moisphoto_get_artists_list($type_lieu); ?></span>
						</h5>

						<p class="has-bordertop--little"><?php echo $lieu_adresse; ?></p>
						
						<p><?php the_field('complement_adresse', $lieu); ?></p>


						<div class="p--small place__details">
<!-- 							<h5 class="h5">Informations pratiques</h6> -->
							<div class="">
								
								<p class="event__place__head has-bordertop--little">Accès</p>

								<?php 
								if( get_field('transport', $lieu) ) {
									the_field('transport', $lieu);
								}

								if( get_field('horaires', $lieu) !='' ) {
									the_field('horaires', $lieu);
									echo '<br>';
								}

								if(get_field('accès', $lieu)) {
									the_field('accès', $lieu);
								}	?>		

								<p class="event__place__head has-bordertop--little">Contact</p>

								<?php if(get_field('telephone', $lieu)) {
									the_field('telephone', $lieu);
									echo '<br>';
								}

								if(get_field('email', $lieu)) {
									the_field('email', $lieu);
									echo '<br>';
								}

								if( get_field('website', $lieu)) { ?>
									<a href="<?php the_field('website', $lieu); ?>" target="_blank">Site internet</a>
								<?php } 


								if(get_field('date_vernissage', $lieu)) {
									echo 'Date du vernissage : ';
									the_field('date_vernissage', $lieu);
									echo '<br>';
								} ?>

							</div>
						</div>
					</div>
					
					<div class="event__map">
					  <h3 class="h3">événements et curiosités proches</h3>

						<div class="part" id="curiosites" title="Les curiosités"></div>

					    <?php 
					      // GET MAP ITEMS AND DISPLAY

								$front_page_id = get_option('page_on_front');
  							$current_edition = get_field('edition_courante', $front_page_id); 

					      $type_relation = get_field('type_relation', $current_edition);
					      
					      $events = array();
					      $places = array();

					      if( $type_relation == 'Weekends') : 
					        $weekends = get_field('weekends',  $current_edition); // ID

					        foreach ($weekends as $we) {
					          $events_list = get_field('events_list', $we);
					          $color_we = get_field('color', $we);
					          $color_we = str_replace('#', '', $color_we); 
					          
					          foreach ($events_list as $e) {
					            $events[] = $e;
					            $places_events_array[$e] = array( get_field('lieu', $e), $color_we );
					          }            
					        }
					        $is_weekend = true; 

					      elseif ( $type_relation == 'Événements' ) :
					        $events = get_field('evenements', $current_edition);

					        foreach ($events as $e) {
					          $places_events_array[$e] = array( get_field('lieu', $e), 'default' );
					        }    
					        $is_weekend = false; 

					      endif; 
					        $is_weekend = false; 

					      set_query_var('events', $events); 
					      set_query_var('places_events_array', $places_events_array); 
					      set_query_var('is_weekend', $is_weekend); 
					      set_query_var('position', $position); 
					      set_query_var('zoom', '13'); 

					      get_template_part( 'template-parts/modules/module', 'map' ); 

					      // END MAP ?>

					  <div class="clearfix event__map__inner">

							<?php 
								if($curiosites_liste) {
									foreach ($curiosites_liste as $c) { 

											$curiosite_adresse_group = get_field('adresse', $c);
											$curiosite_adresse = $curiosite_adresse_group['address'];
											?>

										<h5 class="p--big has-bordertop--little">
											<?php echo get_the_title( $c ); ?><br>
											<span class="p">
												<?php 
													$type_de_curiosite = get_field('type_de_curiosite', $c); 
													moisphoto_get_artists_list($type_de_curiosite); ?>
											</span>
										</h5>

										<div class="has-bordertop--little">

											<p class="p--strong"><?php echo $curiosite_adresse; ?></p>
											
											<?php the_field('description', $c); ?>

										</div>
																			
									<?php }
								}
							?>
						</div>
						
					</div>
				</div>

			</div><!-- .wrap -->
		</div><!-- .event__main -->
		

	<?php if($evenements_lies) : ?>
		<div class="part" id="rebonds" title="Autour de l'exposition"></div>
		<?php 
			set_query_var('rebonds', $evenements_lies); 
		  get_template_part( 'template-parts/modules/module', 'rebonds' ); ?>
	<?php endif; ?>


	<?php if( get_field('mentions') ) : ?>
		<div class="part" id="partenaires" title="Partenaires"></div>
		<section class="module-partners clearfix">
		  <div class="wrap row">  

		    <div class="has-bordertop--big clearfix"></div>   
		    <h3 class="h2 clearfix">Partenaires de l'événement</h3>

		    <?php the_field('mentions'); ?>
		  
		  </div>
		</section>
	<?php endif; ?>

		
	</div><!-- .event__content -->

</article><!-- #post-## -->
