

/**
 * Search load and display
 */

jQuery(document).on( 'submit', '#searchform', function() {
    var $form = jQuery(this);
    var $input = $form.find('input[name="s"]');
    var query = $input.val();
    var $content = jQuery('#searchresults');
    
    jQuery.ajax({
        type: 'post',
        url: myAjax.ajaxurl,
        data: {
            action: 'load_search_results',
            query: query
        },
        beforeSend: function() {
            $input.prop('disabled', true);
            $('.globalsearch-msg').show();
        },
        success: function( response ) {
            $input.prop('disabled', false);
            $content.html( response );
            $content.show('fast');
            $('.globalsearch-msg').hide();
            $('#searchresults').show();
        }
    });
    
    return false;
});

jQuery(document).on('click', '#close-search', function(event) {
    event.preventDefault();

    $('#searchresults').hide('fast');
});



/**
 * Press_Search load and display
 */

jQuery(document).on( 'submit', '#pressform', function() {
    var $form = jQuery(this);
    var $input = $form.find('input[name="s"]');
    var query = $input.val();
    var $content = jQuery('#press__list');
    
    jQuery.ajax({
        type: 'post',
        url: myAjax.ajaxurl,
        data: {
            action: 'press_search',
            query: query
        },
        beforeSend: function() {
            $input.prop('disabled', true);
            $('.presssearch-msg').show();
        },
        success: function( response ) {
            $input.prop('disabled', false);
            $('.presssearch-msg').hide();
            $content.html( response );
            $content.show('fast');
        }
    });
    
    return false;
});



/**
 * Events list load and display
 */

var $events_list_modal = $('#events-modal');
var $content = $events_list_modal.find('.modal__content__inner');

$(document).on( 'click', '.js-display-events', function( event ) {

    event.preventDefault();

    $.ajax({
        url: myAjax.ajaxurl,
        type: 'post',
        data: {
            action: 'load_events'
        },
        beforeSend: function() {
            $content.html('<div class="loader"><img class="" src="wp-content/themes/moisphoto/assets/loader.gif"></div>');
            $events_list_modal.show();
        },
        success: function( result ) {
            $content.html( result );
            $content.show('fast');
            $('.loader').hide();
        }
    });

    return false;
});


jQuery(document).on('click', '#close-events', function(event) {
    event.preventDefault();

    $events_list_modal.hide();
});



/**
 * Nearby events list load and display
 */


$(document).on( 'click', '.js-display-aroundme', function( event ) {

    $content.html('<div class="loader"><img class="" src="wp-content/themes/moisphoto/assets/loader.gif"></div>');
    $events_list_modal.show();

      if (!navigator.geolocation){
        $content.innerHTML = '<p class="position-msg">Désolé, la géolocalisation n\'est pas supporté par votre navigateur.</p>';
        return;
      }

      function success(position) {
        var latitude  = position.coords.latitude;
        var longitude = position.coords.longitude;

        $content.append('<p class="position-msg">Nous avons trouvé votre position géographique. Nous cherchons des événements...</p>');

        $.ajax({
            url: myAjax.ajaxurl,
            type: 'post',
            data: {
                action: 'load_events',
                nearby: true,
                my_latitude: latitude,
                my_longitude: longitude,
            },
            beforeSend: function() {
               $content.append('<p class="position-msg">Nous avons trouvé des événements....</p>');
            },
            success: function( result ) {
                $content.html( result );
                $content.show('fast');
                $('#loading-msg').hide();
            }
        });
      }

      function error() {
        $content.append('<p class="position-msg">Désolé, nous n\'avons pas trouvé votre position géographique.</p>');
      }

      navigator.geolocation.getCurrentPosition(success, error);
});


jQuery(document).on('click', '#close-events', function(event) {
    event.preventDefault();

    $events_list_modal.hide();
});




