

(function($) {






  $(document).ready(function(){

    var display_events_trigger = $('.js-display-events');
    var events_list_modal = $('.events-modal');
    var modal_close_btn = events_list_modal.find('.close');

    display_events_trigger.on('click', function(event){
      event.preventDefault;
      events_list_modal.show();

    });

    modal_close_btn.on('click', function(event){
      event.preventDefault;
      events_list_modal.hide();

    });


  });



})(jQuery);