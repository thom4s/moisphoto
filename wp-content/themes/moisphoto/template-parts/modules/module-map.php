<?php
/*
 *  Markup for map
 *  present field is 'map'
 *  subfields are : 'titre' (texte), 'map' (Google map)
 */

  $blue = '#281EBE';
  $blue_darker = '#1B0290';
  $beige = ' #F0EBDC';
  $beige_lighter = ' #F4F1E6';
  $gray = ' #1C1C1C';

?>


<section class="module map">
  <div class="map-outer">

      <div class="map-inner">
      <?php

        foreach ($places as $place):
          $location = get_field('adresse', $place->ID);

          $current_exhibition = get_posts(array(
            'numberposts' => 1,
            'post_type'   => 'exhibition',
            'meta_key'    => 'lieu',
            'meta_value'  => $place->ID,
          ));

          if($current_exhibition) {
            $current_exhibition_id = $current_exhibition[0]->ID;
            $thumbnail = get_the_post_thumbnail($current_exhibition_id, 'medium' );
            $subtitle = get_field('subtitle', $current_exhibition_id);
            $intro = get_field('introduction', $current_exhibition_id);
            $url = get_permalink ( $current_exhibition_id );
          }
      ?>

          <!-- MARKER -->
          <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">

            <div class="modal-content is-relative">

              <div class="modal-img">
                <div class="row wrap">
                  <div class="m-4col m-1col-push modal-img-inner">
                    <?php echo $thumbnail; ?>
                  </div>
                </div>
              </div>

              <div class="modal-texts">
                <div class="row wrap">

                  <div class="modal-title m-4col m-1col-push">
                    <h3><?php echo $place->post_title; ?></h3>
                    <a href="<?php echo $url; ?>" class=""><span class="btn-rounded circle icon-arrow_right"></span>En savoir plus</a>
                  </div>

                  <div class="modal-practical m-3col m-2col-push">
                    <div class="modal-practical-adresse data"><?php echo get_field('adresse_texte', $place->ID); ?></div>
                    <div class="data modal-practical-metro"><?php echo get_field('metros', $place->ID); ?></div>
                    <div class="data modal-practical-horaires"><?php echo get_field('horaires', $place->ID); ?></div>
                  </div>

                  <div class="modal-subtitle m-2col m-last data">
                    <?php echo $subtitle; ?>
                  </div>


                </div>
              </div>

            </div><!--.modal-content -->
          </div><!--.marker -->

        <?php endforeach; ?>

      </div>

      <div class="modal">
        <div class="wrap">
          <div class="modal-content"></div>
        </div>
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
        { "visibility": "on" }
      ]
    },{
      "featureType": "water",
      "stylers": [
        { "color": "<?php echo $blue_darker; ?>" }
      ]
    },{
      "featureType": "water",
      "elementType": "labels.text",
      "stylers": [
        { "color": "#666666" },
        { "visibility": "on" },
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
        { "visibility": "simplified" }
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
        { "visibility": "on" }
      ]
    },{
      "featureType": "road.arterial",
      "elementType": "labels",
      "stylers": [
        { "visibility": "simplified" }
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
        { "color": "<?php echo $beige; ?>" },
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
        { "color": "#555555" }
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
        { "color": "<?php echo $blue; ?>" },
        { "saturation": 96 },
        { "weight": 1.5 },
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
      zoom              : 10,
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
    map.setOptions({styles: mapStyles});

    
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

    // create marker
    var marker = new google.maps.Marker({
      position  : latlng,
      map     : map,
      //icon    : "<?php echo get_template_directory_uri(); ?>/img/epingle.png"
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
          map.markers[i].setIcon("<?php echo get_template_directory_uri(); ?>/img/epingle.png");
                }
          marker.setIcon("<?php echo get_template_directory_uri(); ?>/img/epingle_released.png");
          $content = $marker.html();
          $('.modal').html($content).show();

          $imgheight = $('.modal').find('.modal-img').height();
          $('.modal').find('.modal-img').css('top', -$imgheight);
          console.log($imgheight);
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
      console.log( $(this) );

      google.maps.event.addDomListener(document.getElementById( '1'), "click", function(ev) {
        map.setCenter(map.markers[1].getPosition());
      });

    });

  });

})(jQuery);
</script>



