/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

    "use strict"; // jshint ;_;

    log.debug('Campus Secondary Navigation AMD');

    return {
        init: function() {
            $(document).ready(function($) {
                log.debug('Campus Secondary Navigation AMD init');
                var secondarynavigation = document.getElementById("secondary-navigation");

                if (secondarynavigation !== null) {
                    var page = document.getElementById("page");
                    var pageScrollTop = page.scrollTop;
                    var navbar = document.getElementById("campusnavbar");

                    var snheight = secondarynavigation.getBoundingClientRect().height;

                    var makeSecondaryNavigationSticky = function() {
                        log.debug('Doc  ' + document.scrollY);
                        log.debug('Win  ' + window.scrollY);
                        log.debug('Body ' + document.body.scrollTop);
                        log.debug('Page ' + page.scrollTop);
                        log.debug('SN   ' + secondarynavigation.scrollY);
                        log.debug('Nav  ' + navbar.scrollTop);
                    };

                    //page.onscroll = function() {makeSecondaryNavigationSticky();};
                    //document.body.onscroll = function() {makeSecondaryNavigationSticky();};
                    document.onscroll = function() {makeSecondaryNavigationSticky();};

                } else {
                    log.debug('Campus no Secondary Navigation when there should be!');
                }
            });
        }
    };
});
/* jshint ignore:end */
