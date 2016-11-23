

(function($) {
  $(document).ready(function(){


    /*
     * Searchbar script
     * Display / Hide searchbars or search results 
     * there is 2 searchbars (desktop & mobile) & 1 results container
     */
    var searchbar = $('.searchbar');

    $('.js-open-searchbar').on('click', function() {
      $(this).parents('.square').siblings('#searchbar').show();
    });

    searchbar.find('.js-close').on('click', function(event) {
      event.preventDefault();
      $(this).parents('.searchbar').hide();

    });

    $('.menu-item-has-children > a').on('click', function(event) {
      event.preventDefault();
    });

    $('.close-search').on('click', function(event) {
      event.preventDefault();
      $('#searchresults').hide();
    });



    /*
     * Add Table of Content on Event page
     */
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

    $('#masthead').append($ToC_parent);


    /*
     * Smooth scrolling
     * Add smooth when clicking an anchor
     */
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



    /*
     * Summary Script
     * modify styles when scrolling
     */
    var event_summary_height = $('.event__summary').height();

    $( window ).scroll(function() {
      var $win = $(window);

      if ($win.scrollTop() > 250) {
        $( "#masthead" ).addClass( "is-reduced" );
        $('.event__summary').addClass("is-reduced");
        $('.event__id').show();
        $('.home .site-logo--little').show();
      }

      if ($win.scrollTop() === 0) {
        $( "#masthead" ).removeClass( "is-reduced" );
        $('.event__summary').removeClass("is-reduced");
        $('.event__id').hide();
        $('.home .site-logo--little').hide();
      }

    });



    /*
     * Mobile menu script
     * Display / Hide mobile menu
     */
    $('#mobile_nav__trigger').on('click', function(event) {
      event.preventDefault();

      $('.main-navigation').toggle();     
      $(this).toggleClass('icon-header-mobile-menu icon-close');
    });




    "use strict";

    var toggles = document.querySelectorAll(".c-hamburger");

    for (var i = toggles.length - 1; i >= 0; i--) {
      var toggle = toggles[i];
      toggleHandler(toggle);
    }

    function toggleHandler(toggle) {
      toggle.addEventListener( "click", function(event) {
        event.preventDefault();
        $('.main-navigation').toggle();
        (this.classList.contains("is-active") === true) ? this.classList.remove("is-active") : this.classList.add("is-active");
      });
    }



  }); // end doc.ready
})(jQuery);