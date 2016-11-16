<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package moisphoto
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="row">


    <?php if ( has_post_thumbnail() ) : ?>
      <div class="entry__media bg--img" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></div>
    <?php endif; ?>

    <div class="wrap">
			<header class="entry__header m-14col is-centered clearfix">

				<h1 class="entry__title">
					<?php the_title(); ?>
				</h1>	

			</header><!-- .entry-header -->
		</div>

		<div class="wrap">
			<div class="entry__content m-14col is-centered clearfix">
				<?php	the_content(); ?>

<p><button onclick="geoFindMe()">Show my location</button></p>
<div id="out"></div>



  <?php 
  // My position (lat and lng)
  // Replace that with variables

  $my_latitude = get_field('lat'); 
  $my_longitude = get_field('lng'); 
 
  echo '<br>';
  echo "les coordonnées de la galerie baudoin lebon : <br>"; 
  echo $my_latitude;
  echo '<br>';
  echo $my_longitude;
  echo '<br>';
  echo '<br>';


  // Calcul the range of lat, lng 
  $rad = 2; // radius of bounding circle in kilometers
  $R = 6371;  // earth's mean radius, km

  $maxLat = $my_latitude + rad2deg( $rad/$R );
  $minLat = $my_latitude - rad2deg( $rad/$R );
  $maxLng = $my_longitude + rad2deg(asin( $rad/$R ) / cos(deg2rad( $lat )));
  $minLng = $my_longitude - rad2deg(asin( $rad/$R ) / cos(deg2rad( $lat )));

  echo "lat & lng max (à 2km autour du point donné) : <br>"; 
  echo $maxLat;
  echo '<br>';
  echo $minLat;
  echo '<br>';
  echo $maxLng;
  echo '<br>';
  echo $minLng;
  echo '<br>';



    $meta_query[] = array(
      'relation' => 'AND', 
      array(
        'key'     => 'lat',
        'value'   => array($minLat, $maxLat),
        'compare' => 'BETWEEN'
      ),
      array(
        'key'     => 'lng',
        'value'   => array($minLng, $maxLng),
        'compare' => 'BETWEEN'
      )
    );

    $nearby_places_args = array(
        'posts_per_page'   => -1,
        'meta_query'       => $meta_query,
        'post_type'        => 'place',
        'post_status'      => 'publish',
        'suppress_filters' => 0 
      );
    $nearby_places_array = get_posts($nearby_places_args);

    //var_dump($nearby_places_array);

    foreach ($nearby_places_array as $p) {
      $id = $p->ID;

      echo '<br>';
      echo '<h4>'.get_the_title( $p->ID ).'</h4>';
      the_field('adresse', $id);
      echo '<br>';
    }


        ?>

			</div><!-- .entry-content -->
		</div>

	</div>
</article><!-- #post-## -->

