

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
    });



    // TABLE OF CONTENT
    $ToC_parent = $("#summary");
    $ToC_id = $("#summary-inner");
    $classes_to_list = $(".part");

    if ( $classes_to_list.length > 1 ) {
      $classes_to_list.each(function(i) {
          var current = $(this);
          current.attr("id", "target-" + i);
          $ToC_id.append("<li class='summary__item'><a class='scroll' id='trigger-" + i + "' href='#target-" +
              i + "' title='" + current.attr("title") + "'>" +
              current.attr("title") + "</a></li>");
      });

      $ToC_parent.show();
    }



    // SMOOTH SCROLLING THING
    var hashTagActive = "";
    $(".scroll").click(function (event) {
        if(hashTagActive != this.hash) { //this will prevent if the user click several times the same link to freeze the scroll.
            event.preventDefault();
            //calculate destination place
            var dest = 0;
            if ($(this.hash).offset().top > $(document).height() - $(window).height()) {
                dest = $(document).height() - $(window).height() - 200;
            } else {
                dest = $(this.hash).offset().top - 150;
            }

            //go to destination
            $('html,body').animate({
                scrollTop: dest
            }, 1000, 'swing');
            hashTagActive = this.hash;
        }
    });


    var event_summary_height = $('.event__summary').height();

    $( window ).scroll(function() {
      var $win = $(window);

      if ($win.scrollTop() > 50) {
        $( "#masthead" ).addClass( "is-reduced" );
        $('.event__summary').addClass("is-reduced");
      }

      if ($win.scrollTop() === 0) {
        $( "#masthead" ).removeClass( "is-reduced" );
        $('.event__summary').removeClass("is-reduced");
      }

    });




  });



})(jQuery);