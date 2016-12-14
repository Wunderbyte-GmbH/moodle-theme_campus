/* jshint ignore:start */
define(['jquery', 'theme_bootstrapbase/bootstrap', 'core/log'], function($, bootstrap, log) {

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
  }
});
/* jshint ignore:end */
