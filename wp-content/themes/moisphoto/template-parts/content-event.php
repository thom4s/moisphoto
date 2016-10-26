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

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="event__header clearfix bg--img">
		<div class="row wrap">
			<div class="m-8col">

				<h1 class="h1"><?php moisphoto_get_artists_list($auteurs); ?></h1>
				
				<h2 class="h2"><?php the_title(); ?></h2>
			
				<?php 
					if($sous_titres) {
						foreach ($sous_titres as $st) {
							echo $st['sous-titre'];
						}
					}
				?>

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
	</header><!-- .entry-header -->

	<div class="event__curators clearfix">
		<div class="wrap row">
			<div class="h5"><?php the_field('nom_commissaire'); ?></div>

		</div>
	</div>	


	<div class="event__content clearfix">

		<div class="event__main clearfix">
			<div class="wrap row">

				<div class="m-16col">

					<div class="p--big event__extract">
						<?php the_field('chapo'); ?>
					</div>

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

						<h3 class="h3">Où ça se passe ?</h3>

						<h5 class="p--big has-bordertop--little">
							<?php echo get_the_title( $lieu ); ?><br>
							<span class="p"><?php $type_lieu = get_field('type_de_lieu', $lieu); moisphoto_get_artists_list($type_lieu); ?></span>
						</h5>

						<p class="has-bordertop--little"><?php echo $lieu_adresse; ?></p>
						
						<p><?php the_field('complement_adresse', $lieu); ?></p>


						<div class="p--small place__details">Informations pratiques</div>
						<div class="p--smaller">
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
							}							

							if(get_field('telephone', $lieu)) {
								the_field('telephone', $lieu);
								echo '<br>';
							}

							if(get_field('email', $lieu)) {
								the_field('email', $lieu);
								echo '<br>';
							}

							if( get_field('website', $lieu)) { ?>
								<a href="<?php the_field('website', $lieu); ?>">Site internet</a>
							<?php } 


							if(get_field('date_vernissage', $lieu)) {
								echo 'Date du vernissage : ';
								the_field('date_vernissage', $lieu);
								echo '<br>';
							} ?>

						</div>

					</div>
					
					<div class="event__map">

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
					      set_query_var('zoom', '15'); 

					      get_template_part( 'template-parts/modules/module', 'map' ); 

					      // END MAP ?>

					  <div class="event__map__inner">

						  <h3 class="h3">événements et curiosités proches</h3>

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

										<p class="has-bordertop--little"><?php echo $curiosite_adresse; ?></p>
										<?php the_field('description', $c); ?>
																			
									<?php }
								}
							?>
						</div>
						
					</div>
				</div>

			</div><!-- .wrap -->
		</div><!-- .event__main -->
		

		<?php 
			set_query_var('rebonds', $evenements_lies); 
		  get_template_part( 'template-parts/modules/module', 'rebonds' ); ?>



	<section class="module-partners clearfix">
	  <div class="wrap row">  

	    <div class="has-bordertop--big clearfix"></div>   
	    <h3 class="h2 clearfix">Partenaires de l'événement</h3>

	    <?php the_field('mentions'); ?>
	  
	  </div>
	</section>

		
	</div><!-- .event__content -->

</article><!-- #post-## -->
