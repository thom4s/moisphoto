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

        <?php 


  // My position (lat and lng)
  // Replace that with variables
  $my_latitude = '48.865390';
  $my_longitude = '2.361799';

  echo '<br>';
  echo "mes coordonnées : <br>"; 
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
  $maxLon = $my_longitude + rad2deg(asin( $rad/$R ) / cos(deg2rad( $lat )));
  $minLon = $my_longitude - rad2deg(asin( $rad/$R ) / cos(deg2rad( $lat )));

  echo "lat & lng max (à 2km autour de moi) : <br>"; 
  echo $maxLat;
  echo '<br>';
  echo $minLat;
  echo '<br>';
  echo $maxLon;
  echo '<br>';
  echo $minLon;
  echo '<br>';


  // galerie baudoin
  //  48.8652352
  //  2.3612143

  $maxLatRange = serialize_array_content( array("lat" => $maxLat) ); // a:1:{s:3:"bar";s:6:"foobar";}
  $minLatRange = serialize_array_content( array("lat" => $minLat) ); // a:1:{s:3:"bar";s:6:"foobar";}
  $maxLonRange = serialize_array_content( array("lng" => $maxLon) ); // a:1:{s:3:"bar";s:6:"foobar";}
  $minLonRange = serialize_array_content( array("lng" => $minLon) ); // a:1:{s:3:"bar";s:6:"foobar";}


  echo '<br>';
  echo "Serialize it : <br>"; 
  echo $maxLatRange;
  echo '<br>';
  echo $minLatRange;
  echo '<br>';
  echo $maxLonRange;
  echo '<br>';
  echo $minLonRange;
  echo '<br>';


    // $meta_query[] = array(
    //   'relation' => 'AND', 
    //   array(
    //     'key'     => 'adresse',
    //     'value'   => array($minLat, $maxLat),
    //     'compare' => 'BETWEEN'
    //   ),
    //   array(
    //     'key'     => 'adresse',
    //     'value'   => array($minLon, $maxLon),
    //     'compare' => 'BETWEEN'
    //   )
    // );

    $meta_query[] = array(
      array(
        'key'     => 'adresse',
        'value'   => $minLatRange,
        'compare' => 'LIKE'
      ),
    );

    $nearby_places_args = array(
        'posts_per_page'   => -1,
        'meta_query'       => $meta_query,
        'post_type'        => 'place',
        'post_status'      => 'publish',
        'suppress_filters' => 0 
      );
    $nearby_places_array = get_posts($nearby_places_args);

    var_dump($nearby_places_array);



        ?>

			</div><!-- .entry-content -->
		</div>

	</div>
</article><!-- #post-## -->

