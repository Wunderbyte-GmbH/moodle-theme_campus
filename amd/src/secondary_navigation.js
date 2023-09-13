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
                    var ntop = navbar.getBoundingClientRect().top;
                    var nheight = navbar.getBoundingClientRect().height;

                    var snheight = secondarynavigation.getBoundingClientRect().height;
                    var sntop = secondarynavigation.getBoundingClientRect().top;

                    var makeSecondaryNavigationSticky = function() {
                        log.debug('Doc  ' + document.scrollY);
                        log.debug('Win  ' + window.scrollY);
                        log.debug('Body ' + document.body.scrollTop);
                        log.debug('Page ' + page.scrollTop);
                        sntop = secondarynavigation.getBoundingClientRect().top;
                        log.debug('SN   ' + sntop);
                        ntop = navbar.getBoundingClientRect().top;
                        log.debug('Nav  ' + ntop);
                        nheight = navbar.getBoundingClientRect().height;
                        log.debug('NavH ' + nheight);
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
