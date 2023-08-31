/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

    "use strict"; // jshint ;_;

    log.debug('Campus affix AMD');

    return {
        init: function() {
            $(document).ready(function($) {
                $("body").addClass("hasaffix");

                // New way to handle sticky navbar requirement.
                // Simply taken from https://www.w3schools.com/howto/howto_js_navbar_sticky.asp.

                // Navbar.
                var navbar = $(".navbar");

                // Initial sticky position.
                var bodyHeader = document.getElementById("body-header");
                var sticky = bodyHeader.offsetTop + bodyHeader.offsetHeight; // This is offsetBottom.

                // When the user scrolls the page, execute makeNavbarSticky().
                window.onscroll = function() {
                    makeNavbarSticky();
                };

                // When the page changes size, check the sticky.
                window.onresize = function() {
                    checkSticky();
                };

                // Changed?
                var isSticky = (window.pageYOffset < sticky); // Initial inverse logic to cause first check to work.

                // Check if we are already down the page because of an anchor etc.
                makeNavbarSticky();

                /**
                 * Add the sticky class to the navbar when you reach its scroll position.
                 *  Remove "sticky" when you leave the scroll position.
                 */
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

                /**
                 *  Adjust sticky if 0 when window resizes.
                 */
                function checkSticky() {
                    if (sticky == 0) {
                        sticky = navbar.offsetTop;
                        isSticky = (window.pageYOffset < sticky);
                        // Check if we are already down the page because of an anchor etc.
                        makeNavbarSticky();
                    }
                }
            });
            log.debug('Campus affix AMD init');
        }
    };
});
/* jshint ignore:end */
