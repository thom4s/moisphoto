<?php
/*
 *  Markup for map
 *  present field is 'map'
 *  subfields are : 'titre' (texte), 'map' (Google map)
 */

  $blue = '#283583';
  $red = ' #DB0819';
  $green = ' #3FA535';
  $gray = ' #1C1C1C';
  $black = '#000000';
  $white = '#ffffff';

  /* 
    $places_events_array
    (
        [event->ID] => array( place->ID, color_we ) 
        [event->ID] => array( place->ID, color_we ) 
        ....
    )
  */
?>


<section class="module-map">
  <div class="map-outer">

      <div class="map-inner">
      <?php

        foreach ($places_events_array as $e => $p):
          // $p[0] = place id
          // $p[1] = color we

          $location = get_field('adresse', $p[0] );
          $lieu_nom = get_the_title($p[0]);


          $thumbnail = get_the_post_thumbnail($e, 'medium' );
          $auteurs = get_field('auteurs', $e);
          $title = get_the_title($e);
          $chapo = get_field('chapo', $e);
          $dates = get_field('dates', $e);
          $url = get_permalink ( $e );
          $date_fixe = get_field('date_fixe', $e);
          if($date_fixe) {
            $dates = get_field('date', $e);
          } 
          else {
            $dates = get_field('date_debut', $e) . ' - ' . get_field('date_fin', $e);
          }

          // CURIOSITES

          $curiosites_liste = get_field('curiosites_liste', $e);

          if( is_array( $curiosites_liste ) ) :
            foreach ($curiosites_liste as $c) : ?>
              <?php 
                $c_location = get_field('adresse', $c); 
                $c_type = get_field('type_de_curiosite', $c); 
                $c_description = get_field('description', $c); 
              ?>

              <!-- MARKER FOR CURIOSITES-->
              <div class="marker" data-lat="<?php echo $c_location['lat']; ?>" data-lng="<?php echo $c_location['lng']; ?>" icon="default_2">
                <div class="modal__close"> <a href="#">x</a> </div>

                <div class="map__modal__content">

                  <div class="modal__img">
                    <?php the_post_thumbnail($c); ?>
                  </div>

                  <div class="modal__texts">
                    <h3 class="h3"><?php echo get_the_title($c); ?></h3>

                    <h3 class="h6"><?php moisphoto_get_artists_list($c_type, false); ?></h3>

                    <div class="modal__intro has-bordertop--little"><?php echo $c_description; ?></div>

                    <p class="has-bordertop--little modal__place"><?php echo $c_location['address']; ?></p>
                  </div>

                </div><!--.modal-content -->
              </div><!--.marker -->

            <?php endforeach; 
          endif; ?>

          <!-- MARKER -->
          <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" icon="<?php echo $p[1]; ?>">
            <div class="modal__close"> <a href="#">x</a> </div>

            <div class="map__modal__content" style="border-color: #<?php echo $p[1]; ?>">

              <div class="modal__img">
                <?php echo $thumbnail; ?>
              </div>

              <div class="modal__texts">

                  <h3 class="h3"><?php moisphoto_get_artists_list($auteurs, false); ?></h3>
                  <h3 class="h6"><?php echo $title; ?></h3>

                  <?php if($chapo) :?>
                    <div class="modal__intro has-bordertop--little"><?php echo $chapo; ?></div>
                  <?php endif; ?>

                  <?php if($dates) :?>
                    <p class="p--strong modal__dates has-bordertop--little"><?php echo $dates; ?></p>
                  <?php endif; ?>

                  <?php if($lieu_nom) :?>
                    <p class="p--strong has-bordertop--little modal__place"><?php echo $lieu_nom; ?></p>
                    <p class="modal__adress"><?php echo $location['address']; ?></p>
                  <?php endif; ?>

              </div>

              <div class="modal__btn" style="background-color: #<?php echo $p[1]; ?>">
                <span class="arrow--little--white"> > </span>
                <a href="<?php echo $url; ?>" class="a--inline">En savoir plus <br>sur l'exposition et le lieu</a></p>
              </div>
              

            </div><!--.modal-content -->
          </div><!--.marker -->

        <?php endforeach; ?>

      </div>

      <div class="map__modal">
          <div class="map__modal__content"></div>
      </div>

    </div><!-- .map-outer -->


</section>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBs3x5sifohlp4Zqy3GxSv-oOF0_z2mx9s"></script>
<script type="text/javascript">


  var mapStyles = [
    {
      "featureType": "poi.attraction",
      "stylers": [
        { "visibility": "simplified" }
      ]
    },{
      "featureType": "poi.business",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "poi.government",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "poi.medical",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "poi.park",
      "stylers": [
        { "visibility": "on" }
      ]
    },{
      "featureType": "poi.place_of_worship",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "poi.school",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "poi.sports_complex",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "water",
      "stylers": [
        { "color": "<?php echo $blue; ?>" }
      ]
    },{
      "featureType": "water",
      "elementType": "labels.text",
      "stylers": [
        { "color": "#666666" },
        { "visibility": "off" },
        { "weight": 0.1 }
      ]
    },{
      "featureType": "transit.line",
      "elementType": "geometry",
      "stylers": [
        { "visibility": "on" },
        { "color": "<?php echo $gray; ?>" },
        { "weight": 1.5 }
      ]
    },{
      "featureType": "road.highway",
      "stylers": [
        { "visibility": "simplified" },
        { "color": "<?php echo $gray; ?>" },
      ]
    },{
      "featureType": "road.arterial",
      "elementType": "labels",
      "stylers": [
        { "visibility": "simplified" }
      ]
    },{
      "featureType": "road.local",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "road.arterial",
      "elementType": "labels",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "road.highway",
      "elementType": "labels",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "transit.station.rail",
      "elementType": "labels.icon",
      "stylers": [
        { "visibility": "on" },
        { "saturation": 100 }
      ]
    },{
      "featureType": "transit.station.rail",
      "elementType": "labels",
      "stylers": [
        { "visibility": "on" }
      ]
    },{
      "featureType": "administrative.locality",
      "stylers": [
        { "visibility": "on" }
      ]
    },{
      "featureType": "landscape.man_made",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "landscape.natural.terrain",
      "elementType": "geometry.fill"  },{
      "featureType": "poi.park",
      "stylers": [
        { "color": "<?php echo $gray; ?>" }
      ]
    },{
      "featureType": "poi.park",
      "elementType": "labels.text.stroke",
      "stylers": [
        { "visibility": "on" },
        { "color": "#444444" }
      ]
    },{
      "featureType": "poi.park",
      "elementType": "labels.text.fill",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "landscape",
      "stylers": [
        { "color": "<?php echo $gray; ?>" },
        { "visibility": "simplified" },
        { "lightness": 60 },
        { "saturation": 6 },
        { "gamma": 1.13 }
      ]
    },{
      "featureType": "road",
      "elementType": "geometry",
      "stylers": [
        { "color": "<?php echo $gray; ?>" },
        { "weight": 0.5 }
      ]
    },{
      "featureType": "administrative",
      "elementType": "labels.text.stroke",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "administrative",
      "elementType": "labels.text.fill",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "administrative",
      "elementType": "labels.text.stroke",
      "stylers": [
        { "visibility": "off" }
      ]
    },{
      "featureType": "road.highway.controlled_access",
      "elementType": "geometry",
      "stylers": [
        { "color": "<?php echo $gray; ?>" },
        { "lightness": 20 }
      ]
    }
  ]; // end map styles



  (function($) {

  /*
  *  new_map
  *
  *  This function will render a Google Map onto the selected jQuery element
  *
  *  @type  function
  *  @date  8/11/2013
  *  @since 4.3.0
  *
  *  @param $el (jQuery element)
  *  @return  n/a
  */

  function new_map( $el ) {
    
    // var
    var $markers = $el.find('.marker');
    
    
    // vars
    var args = {
      zoom              : <?php if( isset($zoom) ) { echo $zoom; } else { echo '11'; } ?>,
      center            : new google.maps.LatLng(48.860532, 2.347772),
      mapTypeId         : google.maps.MapTypeId.ROADMAP,
      draggable         : true,
      panControl        : false,
      scrollwheel       : false,
      streetViewControl : false,
      zoomControl       : true,
    };
    
    
    // create map           
    var map = new google.maps.Map( $el[0], args);
    map.setOptions( {styles: mapStyles} );

    
    // add a markers reference
    map.markers = [];
    
    
    // add markers
    $markers.each(function(){
      
        add_marker( $(this), map );
      
    });
    
    
    // center map
    //center_map( map );
    
    
    // return
    return map;
    
  }

  /*
  *  add_marker
  *
  *  This function will add a marker to the selected Google Map
  *
  *  @type  function
  *  @date  8/11/2013
  *  @since 4.3.0
  *
  *  @param $marker (jQuery element)
  *  @param map (Google Map object)
  *  @return  n/a
  */

  function add_marker( $marker, map ) {

    // var
    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
    var icon_file = "<?php echo get_template_directory_uri(); ?>/assets/icons/" + $marker.attr('icon') + '.png';
    var active_icon_file = "<?php echo get_template_directory_uri(); ?>/assets/icons/active_" + $marker.attr('icon') + '.png';

    var default_icon = {
        url: icon_file,
        scaledSize: new google.maps.Size(16, 16),
    };

    if ( $marker.attr('icon') == 'default_2' ) {
      var active_icon = {
          url: active_icon_file,
          scaledSize: new google.maps.Size(22, 22), 
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 0)
      };
    } 
    else {
      var active_icon = {
          url: active_icon_file,
          scaledSize: new google.maps.Size(48, 48), 
          // The origin for this image is (0, 0).
          origin: new google.maps.Point(0, 0),
          // The anchor for this image is the base of the flagpole at (0, 32).
          anchor: new google.maps.Point(0, 0)
      };
    }

    // create marker
    var marker = new google.maps.Marker({
      position  : latlng,
      map     : map,
      icon    : default_icon,
      icon_backup: default_icon,
      active_icon : active_icon
    });

    // add to array
    map.markers.push( marker );

    // if marker contains HTML, add it to an infoWindow
    if( $marker.html() )
    {
      // create info window
      var infowindow = new google.maps.InfoWindow({
        content   : $marker.html()
      });

      // show info window when marker is clicked
      google.maps.event.addListener(marker, 'click', function() {

        for (i=0; i < map.markers.length; i++ ) {
          var this_icon_backup = map.markers[i].icon_backup;
          console.log(this_icon_backup);

          map.markers[i].setIcon(this_icon_backup);
        }
        
        marker.setIcon( active_icon );
        $content = $marker.html();
        $('.map__modal').html($content).show();

      });
    }

  }

  /*
  *  center_map
  *
  *  This function will center the map, showing all markers attached to this map
  *
  *  @type  function
  *  @date  8/11/2013
  *  @since 4.3.0
  *
  *  @param map (Google Map object)
  *  @return  n/a
  */

  function center_map( map ) {

    // vars
    var bounds = new google.maps.LatLngBounds();

    // loop through all markers and create bounds
    $.each( map.markers, function( i, marker ){

      var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

      bounds.extend( latlng );

    });

    // only 1 marker?
    if( map.markers.length == 1 )
    {
      // set center of map
        map.setCenter( bounds.getCenter() );
        map.setZoom( 16 );
    }
    else
    {
      // fit to bounds
      map.fitBounds( bounds );
    }

  }

  /*
  *  document ready
  *
  *  This function will render each map when the document is ready (page has loaded)
  *
  *  @type  function
  *  @date  8/11/2013
  *  @since 5.0.0
  *
  *  @param n/a
  *  @return  n/a
  */
  // global var
  var map = null;

  $(document).ready(function(){

    $('.map-inner').each(function(){
      map = new_map( $(this) );
    });

    $('.triggers').each(function(ev){
      ev.preventDefault;

      google.maps.event.addDomListener(document.getElementById( '1'), "click", function(ev) {
        map.setCenter(map.markers[1].getPosition());
      });

      $('.modal__close > a').on('click', function(event) {
         event.preventDefault;
        $('.map__modal').hide();
      });

    });

    $('.module-map').show();

  });

})(jQuery);
</script>



