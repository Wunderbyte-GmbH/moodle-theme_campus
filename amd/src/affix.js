/* jshint ignore:start */
define(['jquery', 'theme_bootstrapbase/bootstrap', 'core/log'], function($, bootstrap, log) {

  "use strict"; // jshint ;_;

  log.debug('Campus affix AMD');

  return {
    init: function() {
      $(document).ready(function($) {
        $('.campusnavbar').affix({
          offset: {
            top: function() {
              return $('#page-header').height()
            }
          }
        });
        $("body").addClass("hasaffix");

        // Task #743 - Anchor links have a positioning problem - will only kick in if 'stickynavbar' setting is set.
        // See also: https://github.com/twbs/bootstrap/issues/1768
        // If the navbar is fixed and you have anchor links, then clicking on a link takes you to the target but the target
        // is obscured underneath the navbar.
        var navbarheight = $('.campusnavbar').height();
        navbarheight = navbarheight + 10;
        $('#region-main a[href^=\\"\\#\\"]').each(function() { // Anchors.
            $($(this).attr("href")).css("padding-top", navbarheight + "px").css("margin-top", "-" + navbarheight + "px");
        });
      });
      log.debug('Campus affix AMD init');
    }
  }
});
/* jshint ignore:end */
