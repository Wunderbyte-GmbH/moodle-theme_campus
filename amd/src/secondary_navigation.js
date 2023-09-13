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
                    var down = true;
                    var currentSY = window.scrollY;
                    var newSY = currentSY;
                    var navbar = document.getElementById("campusnavbar");
                    var ntop = navbar.getBoundingClientRect().top;
                    var nheight = navbar.getBoundingClientRect().height;

                    //var snheight = secondarynavigation.getBoundingClientRect().height;
                    var sntop = secondarynavigation.getBoundingClientRect().top;
                    var snft = false;
                    log.debug('Wini ' + currentSY);
                    log.debug('SNi  ' + sntop);
                    var snfromtop = (currentSY + sntop);// + secondarynavigation.getBoundingClientRect().height;
                    if (ntop != 0) {
                        snfromtop = snfromtop - navbar.getBoundingClientRect().height;
                    }
                    log.debug('SNft ' + snfromtop);

                    var makeSecondaryNavigationSticky = function() {
                        newSY = window.scrollY;
                        if (newSY > currentSY) {
                            down = true;
                        } else {
                            down = false;
                        }
                        currentSY = newSY;

                        if (currentSY > snfromtop) {
                            if (down) {
                                if (snft) {
                                    secondarynavigation.classList.remove("fixed-top");
                                    snft = false;
                                }
                            } else {
                                if (!snft) {
                                    secondarynavigation.classList.add("fixed-top");
                                    secondarynavigation.style.top = nheight + 'px';
                                    snft = true;
                                }
                            }
                        } else {
                            if (snft) {
                                secondarynavigation.classList.remove("fixed-top");
                                snft = false;
                            }
                        }

                        log.debug('Win  ' + window.scrollY);
                        sntop = secondarynavigation.getBoundingClientRect().top;
                        log.debug('SN   ' + sntop);
                        ntop = navbar.getBoundingClientRect().top;
                        log.debug('Nav  ' + ntop);
                        nheight = navbar.getBoundingClientRect().height;
                        log.debug('NavH ' + nheight);
                    };

                    document.onscroll = function() {makeSecondaryNavigationSticky();};

                } else {
                    log.debug('Campus no Secondary Navigation when there should be!');
                }
            });
        }
    };
});
/* jshint ignore:end */
