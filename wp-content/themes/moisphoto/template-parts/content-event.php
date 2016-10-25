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
			<p class="h5"><?php the_field('nom_commissaire'); ?></p>

		</div>
	</div>	


	<div class="event__content clearfix">

		<div class="event__main clearfix">
			<div class="wrap row">

				<div class="m-16col">

					<div class="p--big">
						<?php the_field('chapo'); ?>
					</div>

					<div>
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

						<p></p>

					</div>
					
					<div class="event__map">

						<h3>Les curiosités</h3>
						<?php 
							if($curiosites_liste) {
								foreach ($curiosites_liste as $c) {
									echo get_the_title( $c );
									the_field('description', $c);
									the_field('adresse', $c);
									the_field('type_de_curiosite', $c);
								}
							}
						?>

					</div>
				</div>

			</div><!-- .wrap -->
		</div><!-- .event__main -->
		


		<div class="event__rebonds clearfix">
			<div class="wrap">

				<div class="map"></div>

				<h3>Autour de l'événement</h3>

				<?php 
					if($evenements_lies) {
						foreach ($evenements_lies as $e) {
							echo '<h4>'. get_the_title( $e ) . '</h4>';
							the_field('description', $e);
							the_field('adresse', $e);
							the_field('type_de_curiosite', $e);
						}
					}
				?>

			</div>
		</div><!-- .event__rebonds -->



	<section class="event__partners clearfix">
	  <div class="wrap row">  

	    <div class="has-bordertop--big clearfix"></div>   
	    <h3 class="clearfix">Partenaires de l'événement</h3>

	    <?php the_field('mentions'); ?>
	  
	  </div>
	</section>

		
	</div><!-- .event__content -->

</article><!-- #post-## -->
