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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="event__header clearfix">
		<div class="row wrap">

			<div class="m-16col">
				<h1><?php moisphoto_get_artists_list($auteurs); ?></h1>
				<h2><?php the_title(); ?></h2>
			
				<?php 
					if($sous_titres) {
						foreach ($sous_titres as $st) {
							echo $st['sous-titre'];
						}
					}
				?>
			</div>
			
			<div class="m-6col m-last event__short">
				<p><?php 
					if($date_fixe) {
						the_field('date'); 
					} else {
						the_field('date_debut');
						echo ' - ';
						the_field('date_fin');
					}
				?><p>
				<p><?php echo get_the_title( $lieu ); ?></p>
				<p><?php the_field('adresse', $lieu); ?></p>
			</div>
		</div>
		


	</header><!-- .entry-header -->

	<div class="event_curators clearfix">
		<div class="wrap row">
			<p>nom commissaire : <?php the_field('nom_commissaire'); ?></p>

		</div>
	</div>	


	<div class="event__content clearfix">

		<div class="event__main clearfix">
			<div class="wrap row">

				<div class="m-16col">
					<?php	the_content(); ?>
			
					<p>catalogue : <?php the_field('catalogue'); ?></p>

					<p>Contact presse : 
					<?php the_field('nom_contact', $lieu); ?><br>
					<?php the_field('email_contact', $lieu); ?></p>
				</div>
				
				<div class="m-6col m-last">
					<div class="event__place">

						<h3>Le lieu</h3>

						<h5><?php echo get_the_title( $lieu ); ?></h5>
						<p><?php the_field('adresse', $lieu); ?></p>
						<p><?php the_field('complement_adresse', $lieu); ?></p>
						<p><?php the_field('type_de_lieu', $lieu); ?></p>
						<p><?php the_field('transport', $lieu); ?></p>
						<p><?php the_field('horaires', $lieu); ?></p>
						<p><?php the_field('accès', $lieu); ?></p>
						<p><?php the_field('telephone', $lieu); ?></p>
						<p><?php the_field('email', $lieu); ?></p>
						<p><?php the_field('website', $lieu); ?></p>
		
						<p>horaires : <?php the_field('horaires'); ?></p>
						<p>date vernissage : <?php the_field('date_vernissage'); ?></p>

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


		<div class="event__partners clearfix">
			<div class="row wrap">
				<h3>Partenaires</h3>
				<p>remerciements : <?php the_field('mentions'); ?></p>
			</div><!-- .wrap -->
		</div><!-- .event__partners -->

		
	</div><!-- .event__content -->

</article><!-- #post-## -->
