<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<p>auteurs : 
		<?php 
			$auteurs = get_field('auteurs'); 
			foreach ($auteurs as $a) {
				echo get_term($a)->name;
				echo ', ';
			}
		?>
		</p>

		<p>sous titre : 
		<?php 
			$sous_titres = get_field('sous_titres'); 
			foreach ($sous_titres as $st) {
			echo $st['sous-titre'];
			}
		?>
		</p>

		<p>date fixe ? <?php $date_fixe = get_field('date_fixe'); var_dump($date_fixe); ?></p>
		<p>date : <?php the_field('date'); ?></p>
		<p>date début : <?php the_field('date_debut'); ?></p>
		<p>date fin : <?php the_field('date_fin'); ?></p>
		<p>horaires : <?php the_field('horaires'); ?></p>
		<p>date vernissage : <?php the_field('date_vernissage'); ?></p>
		<p>nom commissaire : <?php the_field('nom_commissaire'); ?></p>
		<p>remerciements : <?php the_field('mentions'); ?></p>
		<p>catalogue : <?php the_field('catalogue'); ?></p>

	</header><!-- .entry-header -->



	<div class="entry-content">

		<!-- 
			CURIOSITES
		-->
		<h3>Visuels</h3>
		<p>visuels : <?php the_field('visuels'); ?></p>



		<!-- 
			PRESENTATION
		-->
		<h3>Présentation</h3>
		<?php	the_content(); ?>



		<!-- 
			LE LIEU
		-->
		<h3>Le lieu</h3>
		<?php $lieu = get_field('lieu'); ?>

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

		Contact presse
		<p><?php the_field('nom_contact', $lieu); ?></p>
		<p><?php the_field('email_contact', $lieu); ?></p>




		<!-- 
			CURIOSITES
		-->
		<h3>Les curiosités</h3>
		<?php $curiosites_liste = get_field('curiosites_liste'); ?>

		<?php 
			foreach ($curiosites_liste as $c) {
				echo get_the_title( $c );
				the_field('description', $c);
				the_field('adresse', $c);
				the_field('type_de_curiosite', $c);
			}
		?>



		<!-- 
			AUTOUR DE L'EVENEMENT
		-->
		<h3>Autour de l'événement</h3>
		<p><?php $evenements_lies = get_field('evenements_lies');  ?></p>

		<?php 
			foreach ($evenements_lies as $e) {
				echo '<h4>'. get_the_title( $e ) . '</h4>';
				the_field('description', $e);
				the_field('adresse', $e);
				the_field('type_de_curiosite', $e);
			}
		?>
	</div><!-- .entry-content -->





	<footer class="entry-footer">
		<?php //moisphoto_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
