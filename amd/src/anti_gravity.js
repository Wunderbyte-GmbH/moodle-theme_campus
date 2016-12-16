/* jshint ignore:start */
define(['jquery'], function($) {

  "use strict"; // jshint ;_;

  console.log('Campus anti gravity AMD');

  $(document).ready(function() {
    var showposition = 480;
    var animateduration = 1200;

    $(window).scroll(function() {
      if ($(this).scrollTop() > showposition) {
        $('.antiGravity').fadeIn();
      } else {
        $('.antiGravity').fadeOut();
      }
    });

    $('.antiGravity').click(function(e) {
      e.preventDefault();
      $('html, body').animate({scrollTop : 0}, animateduration);
      return false;
    });

    $(".gotoBottom").click(function(e) {
      e.preventDefault();
      var target = $("#page-footer");
      $('html, body').animate({scrollTop : target.offset().top}, animateduration);
      return false;
    });
  });
});
/* jshint ignore:end */
