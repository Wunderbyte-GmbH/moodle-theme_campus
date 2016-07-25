<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Campus theme with the underlying Bootstrap theme.
 *
 * @package    theme
 * @subpackage campus
 * @copyright  &copy; 2014-onwards G J Barnard in respect to modifications of the Clean theme.
 * @copyright  &copy; 2014-onwards Work undertaken for David Bogner of Edulabs.org.
 * @author     G J Barnard - gjbarnard at gmail dot com and {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if ((!empty($PAGE->theme->settings->frontpagepageheadinglocation)) && ($PAGE->theme->settings->frontpagepageheadinglocation == 2)) {
    echo $OUTPUT->get_page_heading();
}
?>

<header id="page-header" class="clearfix">
    <?php
        // Need the 'page-header' id even if $html->heading is empty for the Affix to work.
        echo $html->heading;
    ?>
</header>

<?php
// Note: $numberofslides established in the header file as pulled in by $OUTPUT->get_header_file() if there are any.
if ((!empty($numberofslides)) && (!empty($PAGE->theme->settings->sliderposition)) && ($PAGE->theme->settings->sliderposition == 1)) {
    require_once(dirname(__FILE__).'/slideshow.php');
}
