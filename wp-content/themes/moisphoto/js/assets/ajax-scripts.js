

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
    event.preventDefault;
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
    event.preventDefault;
    $events_list_modal.hide();
});



/**
 * Nearby events list load and display
 */

var $events_list_modal = $('#events-modal');
var $content = $events_list_modal.find('.modal__content__inner');

$(document).on( 'click', '.js-display-aroundme', function( event ) {

    event.preventDefault();
    var event_latitude = '';
    var event_longitude = '';

    function initGeolocation() {
      if (navigator && navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);

      } else {
        console.log('Geolocation is not supported');
      }
    }
     
    function errorCallback() {
        
    }
     
    function successCallback(position) {
        event_latitude = position.coords.latitude;
        event_longitude = position.coords.longitude;

        $.ajax({
            url: myAjax.ajaxurl,
            type: 'post',
            data: {
                action: 'load_events',
                nearby: true,
                event_latitude: event_latitude,
                event_longitude: event_longitude,
            },
            beforeSend: function() {
                $events_list_modal.show();
                $content.html('<div class="loader"><img class="" src="wp-content/themes/moisphoto/assets/loader.gif"></div>');
            },
            success: function( result ) {
                $content.html( result );
                $content.show('fast');
                $('#loading-msg').hide();
            }
        });

        return false;

    }

    initGeolocation();

});


jQuery(document).on('click', '#close-events', function(event) {
    event.preventDefault;
    $events_list_modal.hide();
});




