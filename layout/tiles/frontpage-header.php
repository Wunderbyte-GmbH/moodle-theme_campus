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
 * @author     G J Barnard - {@link http://moodle.org/user/profile.php?id=442195}
 * @author     Based on code originally written by Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

// Image files.
$hdlogo = $PAGE->theme->setting_file_url('frontpagelogo', 'frontpagelogo');
$hdbackgroundimage = $PAGE->theme->setting_file_url('frontpagebackgroundimage', 'frontpagebackgroundimage');
$hdresponsivelogo = $PAGE->theme->setting_file_url('frontpageresponsivelogo', 'frontpageresponsivelogo');
$hdresponsivebackgroundimage = $PAGE->theme->setting_file_url('frontpageresponsivebackgroundimage', 'frontpageresponsivebackgroundimage');

// Fall back to theme logo and background if no frontpage logo or background.
if ((!$hdlogo) || (!$hdbackgroundimage)) {
    // Note: Please remeber to set the image dimensions in 'theme_campus_extra_less()' of lib.php.
    if ($logodetails = theme_campus_get_theme_logo()) {
        // Note: $hdlogo can still be false if 'image_url' fails for some unknown reason.
        $hdlogo = $OUTPUT->image_url($logodetails['name'], 'theme');
    }
    if ($backgrounddetails = theme_campus_get_theme_background()) {
        // Can still be false if 'image_url' fails for some unknown reason.
        $hdbackgroundimage = $OUTPUT->image_url($backgrounddetails['name'], 'theme');
    }
    // Use theme responsive versions.
    if ($logoresponsivedetails = theme_campus_get_theme_responsive_logo()) {
        // Can still be false if 'image_url' fails for some unknown reason.
        $hdresponsivelogo = $OUTPUT->image_url($logoresponsivedetails['name'], 'theme');
    }
    if ($backgroundresponsivedetails = theme_campus_get_theme_responsive_background()) {
        // Can still be false if 'image_url' fails for some unknown reason.
        $hdresponsivebackgroundimage = $OUTPUT->image_url($backgroundresponsivedetails['name'], 'theme');
    }
}
// End of fall back section.

// Layout.
$hdlayout = (!empty($PAGE->theme->settings->frontpagelayout)) ? $PAGE->theme->settings->frontpagelayout : 'absolutelayout';
$hdflexlayout = ($hdlayout == 'flexlayout');
$hdfancynavbar = false;

$hdbackgroundextrapos = (!empty($PAGE->theme->settings->frontpagelogoposition)) ? $PAGE->theme->settings->frontpagelogoposition : 1; // 1 is left and 2 is right.
// Background is an inversion of logo position.  This has to reflect the true value and not that of $hdlogoextrapos because its adjusted for absolute layout.
if ($hdbackgroundextrapos == 1) {
    $hdbackgroundextra = 'right';
} else {
    $hdbackgroundextra = 'left';
}
if ($hdflexlayout) {
    $hdlogoextrapos = $hdbackgroundextrapos;
    $navbartype = (!empty($PAGE->theme->settings->navbartype)) ? $PAGE->theme->settings->navbartype : 1; // 1 is 'Standard'.
    if ($navbartype == 2) { // 2 is 'Fancy'.
        $hdfancynavbar = true;
        $hdlayout .= ' fancynavbar';
    }
} else {
    $hdlogoextrapos = 2; // Absolute layout has to have the logo after the background for the negative margin to work to place the logo on top of the background.
    // Fancy navbar will not work because background is 100% and thus would go underneath the logo.
}

$hdtype = 'frontpageheader ' . $hdlayout;

$pageheadinglocationheaderarea = (empty($PAGE->theme->settings->frontpagepageheadinglocation)) ? false : $PAGE->theme->settings->frontpagepageheadinglocation;
require_once(dirname(__FILE__) . '/header-tile.php');

// Carousel pre-loading if the frontpage.  If otherwise, then need to also alter theme_campus_page_init() in lib.php.
if ($PAGE->pagelayout == 'frontpage') {
    $frontpagecarouselstatus = (!empty($PAGE->theme->settings->frontpagecarouselstatus)) ? $PAGE->theme->settings->frontpagecarouselstatus : 1;  // 1 is 'Draft'.
    if ($frontpagecarouselstatus == 2) { // Only if published.
        $numberofslides = (!empty($PAGE->theme->settings->numberofslidesforfrontpage)) ? $PAGE->theme->settings->numberofslidesforfrontpage : 0;
        $settingprefix = 'frontpage'; // Cross ref to theme_campus_pluginfile() image serving in lib.php.
    }
}
