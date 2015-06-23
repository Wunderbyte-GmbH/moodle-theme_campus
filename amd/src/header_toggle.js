/* This file is part of Moodle - http://moodle.org/
 *
 * Moodle is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Moodle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Campus theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage campus
 * @copyright  &copy; 2014-onwards G J Barnard in respect to modifications of the Clean theme.
 * @copyright  &copy; 2015-onwards Work undertaken for David Bogner of Edulabs.org.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/* jshint ignore:start */
define(['jquery', 'core/log'], function($, log) {

  "use strict"; // jshint ;_;

  log.debug('Campus header toggle AMD');

  return {
    init: function() {
      $(document).ready(function($) {
        $("body").on( "click", ".headertoggle", function() {
          if ($(this).hasClass("fa-expand")) {
             $(this).removeClass("fa-expand");
             $(this).addClass("fa-compress");
          } else {
             $(this).removeClass("fa-compress");
             $(this).addClass("fa-expand");
          }
          $(".headertoggled").toggle(500);
          $("body").toggleClass("hideheader", 500);
        });
      });
      log.debug('Campus header toggle AMD init');
    }
  }
});
/* jshint ignore:end */
