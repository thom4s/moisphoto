


jQuery(document).on( 'submit', '#searchform', function() {
    var $form = jQuery(this);
    var $input = $form.find('input[name="s"]');
    var query = $input.val();
    var $content = jQuery('#searchresults');
    
    jQuery.ajax({
        type : 'post',
        url : myAjax.ajaxurl,
        data : {
            action : 'load_search_results',
            query : query
        },
        beforeSend: function() {
            $input.prop('disabled', true);
            jQuery('.search-container').addClass('loading');
            jQuery('#loading-msg').show();
        },
        success : function( response ) {
            $input.prop('disabled', false);
            jQuery('#loading-msg').hide();
            jQuery('.search-container').removeClass('loading');
            $content.html( response );
            $content.show('fast');
        }
    });
    
    return false;
});


jQuery(document).on('click', '#close-search', function(event) {
    event.preventDefault;
    jQuery('#searchresults').hide('fast');
});





jQuery(document).on( 'click', '.js-display-events', function(event) {
    event.preventDefault;

    var $events_list_modal = $('#events-modal');
    var $content = $events_list_modal.find('.modal-content');
    
    jQuery.ajax({
        type : 'post',
        url : myAjax.ajaxurl,

        data : {
            action : 'load_events',
        },

        beforeSend: function() {
            $events_list_modal.show();
            $content.addClass('loading');
            jQuery('#loading-msg').show();

        },

        success : function( response ) {

            if(response.type == "success") {
                jQuery('#loading-msg').hide();
                $content.removeClass('loading');
                $content.html( response );
                $content.show('fast');
            }

            else {
                $content.html( 'erreur...' );
            }


        },

    });
    
    return false;
});


jQuery(document).on('click', '#close-events', function(event) {
    event.preventDefault;
    events_list_modal.hide('fast');
});