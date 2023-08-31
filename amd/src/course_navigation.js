/**
 * Campus theme with the underlying Bootstrap theme.
 *
 * @copyright   2015 Gareth J Barnard
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

    "use strict"; // jshint ;_;

    log.debug('Campus Course Navigation AMD.');

    return {
        init: function() {
            log.debug('Campus Course Navigation AMD init.');
            $(document).ready(function($) {
                var navbarHeight = 0;
                var duration = 500;
                var navbar = 0;
                if ($('.navbar').length) {
                    navbar = $('.navbar');
                    navbarHeight = navbar.height();
                    log.debug('Campus Course Navigation AMD navbar height: ' + navbarHeight);
                }

                var page_href_base = location.href;
                var hrefIndex = location.href.indexOf('#');
                log.debug('Campus Course Navigation AMD navigation page_href_base 1: ' + page_href_base);
                log.debug('Campus Course Navigation AMD navigation hrefIndex: ' + hrefIndex);
                if (hrefIndex != -1) {
                    page_href_base = location.href.substring(0, hrefIndex);
                    log.debug('Campus Course Navigation AMD navigation page_href_base 2: ' + page_href_base);
                    // We are an anchor on the same site - otherwise why would this run?  Therefore still need to scroll.
                    var url = location.href;
                    var hash = url.substring(url.indexOf('#') + 1);
                    log.debug('Campus Course Navigation AMD navigation page hash: ' + hash);
                    var target = $('[id="' + hash + '"]');
                    var targetOffset = target.offset().top;
                    var scrollTo = targetOffset;
                    if (navbar) {
                        if (navbar.css('position') == 'fixed') {
                            scrollTo = scrollTo - navbarHeight;
                        } else {
                            // Strange but true.
                            scrollTo = scrollTo - (navbarHeight * 2);
                        }
                    }
                    $('html, body').animate({scrollTop : scrollTo}, duration);
                    log.debug('Campus Course Navigation AMD navigation page scrollTop: ' + scrollTo);
                    log.debug('Campus Course Navigation AMD navigation page target offset: ' + targetOffset);
                }
                $('a[href*=\\"\\#section-\\"]').each( function() {
                    var link_href_base = this.href.substring(0,this.href.indexOf('#'));
                    log.debug('Campus Course Navigation AMD navigation element: ' + $(this).attr('href'));
                    log.debug('Campus Course Navigation AMD navigation link_href_base: ' + link_href_base);
                    if (page_href_base == link_href_base) {
                        $(this).click(function(e) {
                            e.preventDefault();
                            var url = this.href;
                            log.debug('Campus Course Navigation AMD navigation element url: ' + url);
                            var hash = url.substring(url.indexOf('#') + 1);
                            log.debug('Campus Course Navigation AMD navigation element hash: ' + hash);
                            var target = $('[id="' + hash + '"]');
                            if (target) {
                                var targetOffset = target.offset().top;
                                var scrollTo = targetOffset;
                                if (navbar) {
                                    if (navbar.css('position') == 'fixed') {
                                        scrollTo = scrollTo - navbarHeight;
                                    } else {
                                        // Strange but true.
                                        scrollTo = scrollTo - (navbarHeight * 2);
                                    }
                                }
                                $('html, body').animate({scrollTop : scrollTo}, duration);
                                log.debug('Campus Course Navigation AMD navigation element scrollTop: ' + scrollTo);
                                log.debug('Campus Course Navigation AMD navigation element target offset: ' + targetOffset);
                            }
                        });
                    }
                });
            });
        }
    };
});
/* jshint ignore:end */
