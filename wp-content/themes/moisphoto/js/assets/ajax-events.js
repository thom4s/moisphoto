


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