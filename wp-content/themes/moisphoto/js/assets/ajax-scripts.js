

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
            $('.search-container').addClass('loading');
            $('#loading-search-msg').show();
        },
        success: function( response ) {
            $('#searchresults').show();
            $input.prop('disabled', false);
            $('.search-container').removeClass('loading');
            $content.html( response );
            $content.show('fast');
            $('#loading-search-msg').hide();
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
            jQuery('.search-container').addClass('loading');
            jQuery('#loading-msg').show();
        },
        success: function( response ) {
            $input.prop('disabled', false);
            jQuery('#loading-msg').hide();
            jQuery('.search-container').removeClass('loading');
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
            $events_list_modal.show();
            $content.html('loading...');
        },
        success: function( result ) {
            $content.html( result );
            $content.show('fast');
            $('#loading-msg').hide();
        }
    });

    return false;
});


jQuery(document).on('click', '#close-events', function(event) {
    event.preventDefault;
    $events_list_modal.hide();
});




