/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

  "use strict"; // jshint ;_;

  log.debug('Campus affix AMD');

  return {
    init: function() {
      $(document).ready(function($) {
        /*$('.campusnavbar').affix({
          offset: {
            top: function() {
              return $('#page-header').height()
            }
          }
        });*/
        $("body").addClass("hasaffix");
        //$(".navbar").addClass("fixed-top");

        // New way to handle sticky navbar requirement.
        // Simply taken from https://www.w3schools.com/howto/howto_js_navbar_sticky.asp.

        // Navbar.
        var navbar = $(".navbar");

        // Initial sticky position.
        var pageHeader = document.getElementById("page-header");
        var sticky = pageHeader.offsetTop;

        // When the user scrolls the page, execute makeNavbarSticky().
        window.onscroll = function() {
            makeNavbarSticky()
        };

        // When the page changes size, check the sticky.
        window.onresize = function() {
            checkSticky()
        };

        // Changed?
        var isSticky = (window.pageYOffset < sticky); // Initial inverse logic to cause first check to work.

        // Check if we are already down the page because of an anchor etc.
        makeNavbarSticky();

        // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
        function makeNavbarSticky() {
            if (sticky > 0) {
                if (window.pageYOffset >= sticky) {
                    if (isSticky == false) {
                        navbar.addClass("fixed-top");
                        isSticky = true;
                    }
                } else {
                    if (isSticky == true) {
                        navbar.removeClass("fixed-top");
                        isSticky = false;
                    }
                }
            }
        }

        // Adjust sticky if 0 when window resizes.
        function checkSticky() {
            if (sticky == 0) {
                sticky = navbar.offsetTop;
                isSticky = (window.pageYOffset < sticky);
                // Check if we are already down the page because of an anchor etc.
                makeNavbarSticky();
            }
        }

        // Task #743 - Anchor links have a positioning problem - will only kick in if 'stickynavbar' setting is set.
        // See also: https://github.com/twbs/bootstrap/issues/1768
        // If the navbar is fixed and you have anchor links, then clicking on a link takes you to the target but the target
        // is obscured underneath the navbar.
        // TODO - Needed now?
        /*var navbarheight = $('.campusnavbar').height();
        navbarheight = navbarheight + 10;
        $('#region-main a[href^=\\"\\#\\"]').each(function() { // Anchors.
            $($(this).attr("href")).css("padding-top", navbarheight + "px").css("margin-top", "-" + navbarheight + "px");
        });*/
      });
      log.debug('Campus affix AMD init');
    }
  }
});
/* jshint ignore:end */
