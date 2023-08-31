/* jshint ignore:start */
define(['jquery', 'theme_boost/carousel', 'core/log'], function($, carousel, log) {

    "use strict"; // jshint ;_;

    log.debug('Campus carousel AMD');

    return {
        init: function(data) {
            log.debug('Campus carousel AMD init, slide interval: ' + data.slideinterval);
            $( document ).ready(function($) {
                $('\\#campusCarousel').carousel({
                    interval: data.slideinterval
                });
            });
        }
    };
});
/* jshint ignore:end */
