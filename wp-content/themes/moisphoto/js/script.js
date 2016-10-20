

(function($) {


  $(document).ready(function(){

    var $searchbar = $('#searchbar');

    $('.js-open-searchbar').on('click', function() {
      $searchbar.show();
    });

      $searchbar.find('.js-close').on('click', function() {
        $searchbar.hide();
      });

    $('.menu-item-has-children > a').on('click', function(event) {
      event.preventDefault();
    })

  });



})(jQuery);